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

require_once CLASS_REALDIR . 'pages/admin/LC_Page_Admin_Home.php';

/**
 * 管理画面ホーム のページクラス(拡張).
 *
 * LC_Page_Admin_Home をカスタマイズする場合はこのクラスを編集する.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Home_Ex.php 22926 2013-06-29 16:24:23Z Seasoft $
 */
class LC_Page_Admin_Home_Ex extends LC_Page_Admin_Home
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

    // 2.13.2 向けにコミットの予定
    /**
     * 新規受付一覧の取得
     *
     * @return array 新規受付一覧配列
     */
    public function lfGetNewOrder()
    {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        $objQuery->setOrder('order_detail_id');
        $objQuery->setLimit(1);
        $sql_product_name = $objQuery->getSqlWithLimit('product_name', 'dtb_order_detail', 'order_id = dtb_order.order_id');

        $cols = <<< __EOS__
            dtb_order.order_id,
            dtb_order.customer_id,
            dtb_order.order_name01 AS name01,
            dtb_order.order_name02 AS name02,
            dtb_order.total,
            dtb_order.create_date,
            ($sql_product_name) AS product_name,
            (SELECT
                pay.payment_method
            FROM
                dtb_payment AS pay
            WHERE
                dtb_order.payment_id = pay.payment_id
            ) AS payment_method
__EOS__;
        $from = 'dtb_order';
        $where = 'del_flg = 0 AND status <> ?';
        $objQuery->setOrder('create_date DESC');
        $objQuery->setLimit(10);
        $arrNewOrder = $objQuery->select($cols, $from, $where, ORDER_CANCEL);

        foreach ($arrNewOrder as $key => $val) {
            $arrNewOrder[$key]['create_date'] = str_replace('-', '/', substr($val['create_date'], 0,19));
        }

        return $arrNewOrder;
    }
}
