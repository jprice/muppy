<?php
/**
 * Muppy - a PHP URL shortner
 * Copyright (C) 2011 Philip Newborough <corenominal@corenominal.org>
 *
 * http://corenominal.org/muppy-project/
 *
 * This file is part of Muppy.
 *
 * Muppy is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Muppy is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Muppy.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Connect to MySQL database.
 */
function db_connect() {
    global $muppy_conf;
    global $link;
    $link = mysql_connect(
         $muppy_conf['db_address'], 
         $muppy_conf['db_username'], 
         $muppy_conf['db_password']
         )
        or die("MySQL Error: could not connect");
    mysql_select_db($muppy_conf['db_name'])
        or die("MySQL Error: could not select database");
}
/**
 * Exit MySQL database connection.
 */
function db_exit() {
    global $link;
    mysql_close($link);
}
/**
 * Check the existance of MySQL table
 */
function table_exists($table,$db) { 
    $tables = mysql_list_tables($db); 
    while (list($temp) = mysql_fetch_array($tables)) {
        if($temp == $table) {
            return TRUE;
        }
    }
    return FALSE;
}
?>
