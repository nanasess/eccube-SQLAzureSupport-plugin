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
require_once CLASS_REALDIR . 'pages/admin/total/LC_Page_Admin_Total.php';

/**
 * 売上集計 のページクラス(拡張).
 *
 * LC_Page_Admin_Total をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Total_Ex.php 21420 2012-01-22 19:49:37Z Seasoft $
 */
class LC_Page_Admin_Total_Ex extends LC_Page_Admin_Total {

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        parent::process();
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    // 会員、非会員集計のWHERE分の作成
    function lfGetWhereMember($col_date, $sdate, $edate, $type, $col_member = "customer_id") {
        if (DB_TYPE != 'sqlsrv') {
            return parent::lfGetWhereMember($col_date, $sdate, $edate, $type, $col_member);
        } else {
            $where = "";
            // 取得日付の指定
            if($sdate != "") {
                if ($where != "") {
                    $where.= " AND ";
                }
                $where.= " $col_date >= '". $sdate ."'";
            }

            if($edate != "") {
                if ($where != "") {
                    $where.= " AND ";
                }
                $edate = date("Y/m/d",strtotime("1 day" ,strtotime($edate)));
                $where.= " $col_date < '" . $edate ."'";
            }

            // 会員、非会員の判定
            switch($type) {
                // 全体
            case 'all':
                break;
            case 'member':
                if ($where != "") {
                    $where.= " AND ";
                }
                $where.= " $col_member <> 0";
                break;
            case 'nonmember':
                if ($where != "") {
                    $where.= " AND ";
                }
                $where.= " $col_member = 0";
                break;
            default:
                break;
            }
            return array($where, array());
        }
    }

    /** 期間別集計 **/
    // todo あいだの日付埋める
    function lfGetOrderTerm($type, $sdate, $edate) {
        if (DB_TYPE != 'sqlsrv') {
            return parent::lfGetOrderTerm($type, $sdate, $edate);
        } else {
            $objQuery   = SC_Query_Ex::getSingletonInstance();

            list($where, $arrval) = $this->lfGetWhereMember('create_date', $sdate, $edate);
            $where .= " AND del_flg = 0 AND status <> " . ORDER_CANCEL;

            switch($type){
            case 'month':
                $xtitle = "(月別)";
                $ytitle = "(売上合計)";
                $format = '%m';
                break;
            case 'year':
                $xtitle = "(年別)";
                $ytitle = "(売上合計)";
                $format = '%Y';
                break;
            case 'wday':
                $xtitle = "(曜日別)";
                $ytitle = "(売上合計)";
                $format = '%a';
                break;
            case 'hour':
                $xtitle = "(時間別)";
                $ytitle = "(売上合計)";
                $format = '%H';
                break;
            default:
                $xtitle = "(日別)";
                $ytitle = "(売上合計)";
                $format = '%Y-%m-%d';

                break;
            }

            // TODO リファクタリング
            switch($type){
            case 'month':
                $format = 'datepart(mm, create_date)';
                break;
            case 'year':
                $format = 'datepart(yyyy, create_date)';
                break;
            case 'wday':
                $format = 'datename(weekday, create_date)';
                break;
            case 'hour':
                $format = 'datepart(hh, create_date)';
                break;
            default:
                $format = 'convert(varchar(10), create_date, 111)';
                break;
            }
            $dbFactory = SC_DB_DBFactory_Ex::getInstance();
            // todo postgres
            $col = $dbFactory->getOrderTotalDaysWhereSql($format);

            $objQuery->setGroupBy($format);
            $objQuery->setOrder($format);
            // 検索結果の取得
            $arrTotalResults = $objQuery->select($col, 'dtb_order', $where);

            $arrTotalResults = $this->lfAddBlankLine($arrTotalResults, $type, $sdate, $edate);
            // todo GDない場合の処理
            $tpl_image       = $this->lfGetGraphLine($arrTotalResults, 'str_date', "term_" . $type, $xtitle, $ytitle, $sdate, $edate);
            $arrTotalResults = $this->lfAddTotalLine($arrTotalResults);

            return array($arrTotalResults, $tpl_image);
        }
    }

    function lfDateTimeArray($type, $st, $ed) {
        if (DB_TYPE != 'sqlsrv') {
            return parent::lfDateTimeArray($type, $st, $ed);
        } else {
            switch($type){
            case 'month':
                $format        = 'm';
                break;
            case 'year':
                $format        = 'Y';
                break;
            case 'wday':
                $format        = 'l';
                break;
            case 'hour':
                $format        = 'G';
                break;
            default:
                $format        = 'Y/m/d';
                break;
            }

            if ($type == 'hour') {
                $arrDateList = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23');

            } else {
                $arrDateList = array();
                $tmp    = strtotime($st);
                $nAday  = 60*60*24;
                $edx    = strtotime($ed);
                while( $tmp <= $edx ){
                    $sDate = date($format, $tmp);
                    if( !in_array($sDate, $arrDateList) ){
                        $arrDateList[] = $sDate;
                    }
                    $tmp += $nAday;
                }
            }
            return $arrDateList;
        }
    }
}
