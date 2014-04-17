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

require_once CLASS_REALDIR . 'pages/products/LC_Page_Products_List.php';

/**
 * LC_Page_Products_List のページクラス(拡張).
 *
 * LC_Page_Products_List をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Products_List_Ex.php 22926 2013-06-29 16:24:23Z Seasoft $
 */
class LC_Page_Products_List_Ex extends LC_Page_Products_List
{
    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init()
    {
        parent::init();
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process()
    {
        parent::process();
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy()
    {
        parent::destroy();
    }

    /* 商品一覧の表示 */
    public function lfGetProductsList($searchCondition, $disp_number, $startno, &$objProduct)
    {
        if (DB_TYPE != 'sqlsrv') {
            return parent::lfGetProductsList($searchCondition, $disp_number, $startno, $objProduct);
        } else {
            $arrOrderVal = array();

            $objQuery =& SC_Query_Ex::getSingletonInstance();
            // 表示順序
            switch ($this->orderby) {
                // 販売価格が安い順
            case 'price':
                $objProduct->setProductsOrder('price02', 'dtb_products_class', 'ASC');
                break;

                // 新着順
            case 'date':
                $objProduct->setProductsOrder('create_date', 'dtb_products', 'DESC');
                break;

            default:
                if (strlen($searchCondition['where_category']) >= 1) {
                    $dtb_product_categories = '(SELECT * FROM dtb_product_categories WHERE '.$searchCondition['where_category'].')';
                    $arrOrderVal           = $searchCondition['arrvalCategory'];
                } else {
                    $dtb_product_categories = 'dtb_product_categories';
                }
                $order = <<< __EOS__
                    (
                        SELECT TOP 1
                            T3.rank * 2147483648 + T2.rank
                        FROM
                            $dtb_product_categories T2
                            JOIN dtb_category T3
                              ON T2.category_id = T3.category_id
                        WHERE T2.product_id = alldtl.product_id
                        ORDER BY T3.rank DESC, T2.rank DESC
                    ) DESC
                    ,product_id DESC
__EOS__;
                $objQuery->setOrder($order);
                break;
            }
            // 取得範囲の指定(開始行番号、行数のセット)
            $objQuery->setLimitOffset($disp_number, $startno);
            $objQuery->setWhere($searchCondition['where']);

            // 表示すべきIDとそのIDの並び順を一気に取得
            $arrProductId = $objProduct->findProductIdsOrder($objQuery, array_merge($searchCondition['arrval'], $arrOrderVal));

            $objQuery =& SC_Query_Ex::getSingletonInstance();
            $arrProducts = $objProduct->getListByProductIds($objQuery, $arrProductId);

            // 規格を設定
            $objProduct->setProductsClassByProductIds($arrProductId);
            $arrProducts['productStatus'] = $objProduct->getProductStatus($arrProductId);
            return $arrProducts;
        }
    }

}
