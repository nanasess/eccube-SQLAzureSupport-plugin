<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2011 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// {{{ requires
require_once CLASS_REALDIR . 'db/SC_DB_DBFactory.php';

/**
 * SQL Server 固有の処理をするクラス.
 *
 * このクラスを直接インスタンス化しないこと.
 * 必ず SC_DB_DBFactory クラスを経由してインスタンス化する.
 * また, SC_DB_DBFactory クラスの関数を必ずオーバーライドしている必要がある.
 *
 * @package DB
 * @author LOCKON CO.,LTD.
 * @version $Id:SC_DB_DBFactory_PGSQL.php 15532 2007-08-31 14:39:46Z nanasess $
 */
class SC_DB_DBFactory_SQLSRV extends SC_DB_DBFactory
{

    /**
     * DBのバージョンを取得する.
     *
     * @param string $dsn データソース名
     * @return string データベースのバージョン
     */
    function sfGetDBVersion($dsn = "")
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance($dsn);
        $val = $objQuery->getOne("select @@version");
        return str_replace("\r\n", " ", $val);
    }

    /**
     * MySQL 用の SQL 文に変更する.
     *
     * DB_TYPE が SQLSRV の場合は SQL Server 用の SQL 文に置換する.
     *
     * @access private
     * @param string $sql SQL 文
     * @return string MySQL 用に置換した SQL 文
     */
    function sfChangeMySQL($sql)
    {
        $sql = $this->sfChangeILIKE($sql);
        $sql = $this->sfChangeArrayToString($sql);
        $sql = $this->convertRecommendSql($sql);

        return $sql;
    }

    /**
     * ARRAY_TO_STRING(ARRAY(A),B) を GROUP_CONCAT() に変換する.
     *
     * @access private
     * @param string $sql SQL文
     * @return string 変換後の SQL 文
     */
    function sfChangeArrayToString($sql)
    {
        if(strpos(strtoupper($sql), 'ARRAY_TO_STRING') !== FALSE) {
            preg_match_all('/ARRAY_TO_STRING.*?\(.*?ARRAY\(.*?SELECT (.+?) FROM (.+?) WHERE (.+?)\).*?\,.*?\'(.+?)\'.*?\)/is', $sql, $match, PREG_SET_ORDER);

            foreach($match as $item) {
                $replace = "CAST ({$item[1]} AS varchar) + '" . $item[4] . "' FROM " . $item[2] . " WHERE " . $item[3] . " FOR XML PATH('')";
                $sql = str_replace($item[0], $replace, $sql);
            }
        }
        return $sql;
    }

    /**
     * 関連商品の SQL を変換する。
     *
     * @param string SQL 文
     * @return string 変換後の SQL 文
     */
    function convertRecommendSql($sql)
    {
        if (strpos(strtoupper($sql), ') AS RECOMMEND_') !== FALSE) {
            $pattern = '/\(SELECT (comment|recommend_product_id) FROM dtb_recommend_products WHERE (.*?) ORDER BY (.*?) limit 1 offset (\d+)\) AS ((recommend_comment|recommend_product_id)\d+)/';
            $replacement = '(SELECT \1 FROM dtb_recommend_products WHERE \2 ORDER BY \3 OFFSET \4 ROWS FETCH NEXT 1 ROWS ONLY) AS \5';
            $sql = preg_replace($pattern, $replacement, $sql);
        }

        return $sql;
    }

    /**
     * 昨日の売上高・売上件数を算出する SQL を返す.
     *
     * @param string $method SUM または COUNT
     * @return string 昨日の売上高・売上件数を算出する SQL
     */
    function getOrderYesterdaySql($method)
    {
        return "SELECT ".$method."(total) FROM dtb_order "
              . "WHERE del_flg = 0 "
                . "AND create_date >= convert(varchar(10),getdate()-1,111) AND create_date < convert(varchar(10),getdate(),111) "
                . "AND status <> " . ORDER_CANCEL;
    }

    /**
     * 当月の売上高・売上件数を算出する SQL を返す.
     *
     * @param string $method SUM または COUNT
     * @return string 当月の売上高・売上件数を算出する SQL
     */
    function getOrderMonthSql($method)
    {
        return "SELECT ".$method."(total) FROM dtb_order "
              . "WHERE del_flg = 0 "
                . "AND create_date >= convert(varchar(10), YEAR(getdate())) + '/' + convert(varchar(10), MONTH(getdate())) + '/01'"
                . "AND convert(varchar(10), create_date, 111) <> convert(varchar(10),getdate(),111) "
                . "AND status <> " . ORDER_CANCEL;
    }

    /**
     * 昨日のレビュー書き込み件数を算出する SQL を返す.
     *
     * @return string 昨日のレビュー書き込み件数を算出する SQL
     */
    function getReviewYesterdaySql()
    {
        return "SELECT COUNT(*) FROM dtb_review AS A "
          . "LEFT JOIN dtb_products AS B "
                 . "ON A.product_id = B.product_id "
              . "WHERE A.del_flg=0 "
                . "AND B.del_flg = 0 "
                . "AND A.create_date >= convert(varchar(10),getdate()-1,111) AND A.create_date < convert(varchar(10),getdate(),111) ";
    }

    /**
     * メール送信履歴の start_date の検索条件の SQL を返す.
     *
     * @deprecated
     * @return string 検索条件の SQL
     */
    function getSendHistoryWhereStartdateSql()
    {
        // FIXME
        return null;
    }

    /**
     * ダウンロード販売の検索条件の SQL を返す.
     *
     * @param string $dtb_order_alias
     * @return string 検索条件の SQL
     */
    function getDownloadableDaysWhereSql($dtb_order_alias = 'dtb_order')
    {
        $baseinfo = SC_Helper_DB_Ex::sfGetBasisData();
        //downloadable_daysにNULLが入っている場合(無期限ダウンロード可能時)もあるので、NULLの場合は0日に補正
        $downloadable_days = $baseinfo['downloadable_days'];
        if($downloadable_days ==null || $downloadable_days == "")$downloadable_days=0;
        return "(SELECT CASE WHEN (SELECT d1.downloadable_days_unlimited FROM dtb_baseinfo d1) = 1 AND " . $dtb_order_alias . ".payment_date IS NOT NULL THEN 1 WHEN CURRENT_TIMESTAMP <= convert(datetimeoffset, DATEADD(day, ${downloadable_days}, ${dtb_order_alias}.payment_date)) THEN 1 ELSE 0 END)";
        return 1; // FIXME
    }

    /**
     * 売上集計の期間別集計のSQLを返す
     *
     * @param mixed $type
     * @return string 検索条件のSQL
     */
    function getOrderTotalDaysWhereSql($format)
    {

        return $format . " AS str_date,
            COUNT(order_id) AS total_order,
            SUM(CASE WHEN order_sex = 1 THEN 1 ELSE 0 END) AS men,
            SUM(CASE WHEN order_sex = 2 THEN 1 ELSE 0 END) AS women,
            SUM(CASE WHEN customer_id <> 0 AND order_sex = 1 THEN 1 ELSE 0 END) AS men_member,
            SUM(CASE WHEN customer_id <> 0 AND order_sex = 2 THEN 1 ELSE 0 END) AS women_member,
            SUM(CASE WHEN customer_id = 0 AND order_sex = 1 THEN 1 ELSE 0 END) AS men_nonmember,
            SUM(CASE WHEN customer_id = 0 AND order_sex = 2 THEN 1 ELSE 0 END) AS women_nonmember,
            SUM(total) AS total,
            AVG(total) AS total_average";
    }

    /**
     * 売上集計の年代別集計の年代抽出部分のSQLを返す
     *
     * @return string 年代抽出部分の SQL
     */
    function getOrderTotalAgeColSql()
    {
        return 'SELECT order_id,total,create_date ,del_flg ,status,customer_id,CASE
      WHEN RIGHT(CONVERT(CHAR(8) , order_birth, 112), 4) > RIGHT(CONVERT(CHAR(8) , create_date, 112), 4) THEN ROUND(YEAR(create_date) - YEAR(order_birth) - 1,-1,1)
      ELSE ROUND(YEAR(create_date) - YEAR(order_birth),-1,1)
   END as age FROM dtb_order';
    }

    /**
     * 文字列連結を行う.
     *
     * @param array $columns 連結を行うカラム名
     * @return string 連結後の SQL 文
     */
    function concatColumn($columns)
    {
        $sql = "";
        $i = 0;
        $total = count($columns);
        foreach ($columns as $column) {
            $sql .= $column;
            if ($i < $total -1) {
                $sql .= " + ";
            }
            $i++;
        }
        return $sql;
    }

    /**
     * テーブルを検索する.
     *
     * 引数に部分一致するテーブル名を配列で返す.
     *
     * @deprecated SC_Query::listTables() を使用してください
     * @param string $expression 検索文字列
     * @return array テーブル名の配列
     */
    function findTableNames($expression = "")
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $sql = 'SELECT name FROM sysobjects WHERE xtype = \'u\' AND name LIKE \'mtb_%\' order by name';
        $arrColList = $objQuery->getAll($sql);
        $arrColList = SC_Utils_Ex::sfSwapArray($arrColList, false);
        $arrList = array();
        foreach($arrColList[0] as $val){
            $arrList[$val] = $val ;
        }

        return $arrList;
    }

    /**
     * 文字コード情報を取得する
     *
     * @return array 文字コード情報
     */
    function getCharSet()
    {
        // 未実装
        return array();
    }

    /**
     * 擬似表を表すSQL文(FROM 句)を取得する
     *
     * @return string
     */
    function getDummyFromClauseSql()
    {
        return '';
    }

    /**
     * ILIKE句 を LIKE句へ変換する.
     *
     * @access private
     * @param string $sql SQL文
     * @return string 変換後の SQL 文
     */
    function sfChangeILIKE($sql)
    {
        $changesql = preg_replace('/(^|[^\w])ILIKE([^\w]|$)/i', '$1LIKE$2', $sql);
        return $changesql;
    }

    /**
     * SQL 文に OFFSET, LIMIT を付加する。
     *
     * @param string 元の SQL 文
     * @param integer LIMIT
     * @param integer OFFSET
     * @return string 付加後の SQL 文
     */
    function addLimitOffset($sql, $limit = 0, $offset = 0)
    {
        if (strlen($offset) === 0) {
            $offset = 0;
        }
        $sql .= " OFFSET $offset ROWS";
        if ($limit != 0) {
            $sql .= " FETCH NEXT $limit ROWS ONLY";
        }

        return $sql;
    }

    /**
     * 商品詳細の SQL を取得する.
     *
     * PostgreSQL 用にチューニング。
     * @param  string $where_products_class 商品規格情報の WHERE 句
     * @return string 商品詳細の SQL
     */
    public function alldtlSQL($where_products_class = '')
    {
        if (!SC_Utils_Ex::isBlank($where_products_class)) {
            $where_products_class = 'AND (' . $where_products_class . ')';
        }
        /*
         * point_rate, deliv_fee は商品規格(dtb_products_class)ごとに保持しているが,
         * 商品(dtb_products)ごとの設定なので MAX のみを取得する.
         */
        $sub_base = "FROM dtb_products_class WHERE del_flg = 0 AND product_id = dtb_products.product_id $where_products_class";
        $sql = <<< __EOS__
            (
                SELECT
                     dtb_products.*
                    ,dtb_maker.name AS maker_name
                    ,(SELECT MIN(product_code) $sub_base) AS product_code_min
                    ,(SELECT MAX(product_code) $sub_base) AS product_code_max
                    ,(SELECT MIN(price01) $sub_base) AS price01_min
                    ,(SELECT MAX(price01) $sub_base) AS price01_max
                    ,(SELECT MIN(price02) $sub_base) AS price02_min
                    ,(SELECT MAX(price02) $sub_base) AS price02_max
                    ,(SELECT MIN(stock) $sub_base) AS stock_min
                    ,(SELECT MAX(stock) $sub_base) AS stock_max
                    ,(SELECT MIN(stock_unlimited) $sub_base) AS stock_unlimited_min
                    ,(SELECT MAX(stock_unlimited) $sub_base) AS stock_unlimited_max
                    ,(SELECT MAX(point_rate) $sub_base) AS point_rate
                    ,(SELECT MAX(deliv_fee) $sub_base) AS deliv_fee
                FROM dtb_products
                    LEFT JOIN dtb_maker
                        ON dtb_products.maker_id = dtb_maker.maker_id
                WHERE EXISTS(SELECT * $sub_base)
            ) AS alldtl
__EOS__;

        return $sql;
    }
}
