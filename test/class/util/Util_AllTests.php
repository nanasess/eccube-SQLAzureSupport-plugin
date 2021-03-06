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

// {{{ requires
// {{{ requires
require_once(realpath(dirname(__FILE__)) . '/SC_Utils_Test.php');

/**
 * Util パッケージのテストケース.
 *
 * @package Util
 * @author Kentaro Ohkouchi
 * @version $Id:LC_Page_Test.php 15116 2007-07-23 11:32:53Z nanasess $
 */
class Util_AllTests extends PHPUnit_Framework_TestCase 
{

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Util');
        $suite->addTestSuite('SC_Utils_Test');

        return $suite;
    }
}
?>
