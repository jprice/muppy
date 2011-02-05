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
 * Perform database set-up, if needed.
 */
db_connect();
if (!table_exists('muppy_urls', $muppy_conf['db_name'])) {
    /**
     * Create main database table.
     */
    mysql_query('CREATE TABLE `'.$muppy_conf['db_name'].'`.`muppy_urls` (
                `_id` BIGINT NOT NULL AUTO_INCREMENT ,
                `_key` VARCHAR( 255 ) NOT NULL ,
                `_url` VARCHAR( 500 ) NOT NULL ,
                `_date_added` DATETIME NOT NULL DEFAULT \'0000-00-00 00:00:00\',
                `_date_last_accessed` DATETIME NOT NULL DEFAULT \'0000-00-00 00:00:00\',
                `_views` BIGINT NOT NULL DEFAULT \'0\',
                PRIMARY KEY ( `_id` )
                ) ENGINE = MYISAM DEFAULT CHARSET=utf8 ;')
    or die("MySQL Error: ".mysql_error());
    /**
     * Insert example record.
     */
    $sql = "INSERT INTO  `".$muppy_conf['db_name']."`.`muppy_urls` (
            `_id` ,
            `_key` ,
            `_url` ,
            `_date_added` ,
            `_date_last_accessed` ,
            `_views`
            )
            VALUES (
            NULL ,  
            '0',  
            'http://corenominal.org/muppy-project/',  
            '".date('Y-m-d H:i:s')."',  
            '".date('Y-m-d H:i:s')."',  
            '0'
            );";
    mysql_query($sql, $link) or die("MySQL Error: ".mysql_error() );
}
db_exit(); 
?>
