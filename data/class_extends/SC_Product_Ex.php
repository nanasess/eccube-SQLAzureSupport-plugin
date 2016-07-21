<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2013 LOCKON CO.,LTD. All Rights Reserved.
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

require_once CLASS_REALDIR . 'SC_Product.php';

class SC_Product_Ex extends SC_Product
{
    // 2.13.2 向けにコミットの予定
    /**
     * SC_Queryインスタンスに設定された検索条件を元に並び替え済みの検索結果商品IDの配列を取得する。
     *
     * 検索条件は, SC_Query::setWhere() 関数で設定しておく必要があります.
     *
     * @param  SC_Query $objQuery SC_Query インスタンス
     * @param  array    $arrVal   検索パラメーターの配列
     * @return array    商品IDの配列
     */
    public function findProductIdsOrder(&$objQuery, $arrVal = array())
    {
        $table = 'dtb_products AS alldtl';

        if (is_array($this->arrOrderData) and $objQuery->order == '') {
            $o_col = $this->arrOrderData['col'];
            $o_table = $this->arrOrderData['table'];
            $o_order = $this->arrOrderData['order'];
            $objQuery->setOrder("T2.$o_col $o_order");
            $objQuery->setLimit(1);
            $sub_sql = $objQuery->getSqlWithLimit($o_col, "$o_table AS T2", 'T2.product_id = alldtl.product_id');

            $objQuery->setOrder("($sub_sql) $o_order, product_id");
        }
        $arrReturn = $objQuery->getCol('alldtl.product_id', $table, '', $arrVal);

        return $arrReturn;
    }
}
