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

require_once CLASS_REALDIR . 'SC_SelectSql.php';

class SC_SelectSql_Ex extends SC_SelectSql
{
	//--　期間検索（○年○月○日か~○年○月○日まで）
    public function selectTermRange($from_year, $from_month, $from_day, $to_year, $to_month, $to_day, $column)
    {
        $return = array();

        // 開始期間の構築
        $date1 = $from_year . '/' . $from_month . '/' . $from_day;

        // 終了期間の構築
        // @see http://svn.ec-cube.net/open_trac/ticket/328
        // FIXME とりあえずintvalで対策...
        $date2 = mktime (0, 0, 0, intval($to_month), intval($to_day), intval($to_year));
        $date2 = $date2 + 86400;
        // SQL文のdate関数に与えるフォーマットは、yyyy/mm/ddで指定する。
        $date2 = date('Y/m/d', $date2);

        // 開始期間だけ指定の場合
        if (($from_year != '') && ($from_month != '') && ($from_day != '') && ($to_year == '') && ($to_month == '') && ($to_day == '')) {
            $this->setWhere($column .' >= ?');
            $return[] = $date1;
        }

        //　開始～終了
        if (($from_year != '') && ($from_month != '') && ($from_day != '')
            && ($to_year != '') && ($to_month != '') && ($to_day != '')
        ) {
            $this->setWhere($column . ' >= ? AND ' . $column . ' < ?');
            $return[] = $date1;
            $return[] = $date2;
        }

        // 終了期間だけ指定の場合
        if (($from_year == '') && ($from_month == '') && ($from_day == '') && ($to_year != '') && ($to_month != '') && ($to_day != '')) {
            $this->setWhere($column . ' < ?');
            $return[] = $date2;
        }

        return $return;
    }
}
