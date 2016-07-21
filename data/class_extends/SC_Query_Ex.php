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

require_once CLASS_REALDIR . 'SC_Query.php';

class SC_Query_Ex extends SC_Query
{

    /**
     * 次のシーケンス値を取得する.
     *
     * @param string $seq_name 取得するシーケンス名
     * @param integer 次のシーケンス値
     */
    function nextVal($seq_name)
    {
        $dsn = array('phptype'  => DB_TYPE,
                     'username' => DB_USER,
                     'password' => DB_PASSWORD,
                     'protocol' => 'tcp',
                     'hostspec' => DB_SERVER,
                     'port'     => DB_PORT,
                     'database' => DB_NAME
                     );
        // SQL Azure では必ず新しいセッションを使用する
        $_conn = MDB2::connect($dsn, $options);
        return $_conn->nextID($seq_name, false);
    }

    // 2.13.2 向けにコミットの予定
    /**
     * 構築した SELECT 文を LIMIT OFFSET も含め取得する.
     *
     * @param  string SELECT 文に含めるカラム名
     * @param  string SELECT 文に含めるテーブル名
     * @param  string SELECT 文に含める WHERE 句
     * @return string 構築済みの SELECT 文
     */
    function getSqlWithLimit($cols, $from = '', $where = '')
    {
        $sql = $this->getSql($cols, $from, $where);
        $offset = $this->conn->offset;
        $limit = $this->conn->limit;
        $this->setLimitOffset(0, 0);

        return $this->dbFactory->addLimitOffset($sql, $limit, $offset);
    }
}
