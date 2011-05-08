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
/**
 * Lookup URL key
 */
function db_key_lookup($_key){
    global $muppy_conf,$link;
    db_connect();
    if(mysql_num_rows(mysql_query("SELECT `_id` FROM `muppy_urls` WHERE".
    " `_key` = '".$_key."'"))){
        return true;
    }else{
        return false;
    }
    db_exit();
}
/**
 * Update record and return long URL
 */
function fetch_muppy_url($_key){
    global $muppy_conf,$link;
    $sql = "SELECT * FROM `muppy_urls` "
    ."WHERE `_key` = '".$_key."'";
    db_connect();
    $result=mysql_query($sql)or die("MySQL Error: ".mysql_error());;
    $key_data = mysql_fetch_assoc($result);
    $x=$key_data['_views']+1;
    $sql = "UPDATE `muppy_urls` SET "
    ."`_date_last_accessed` =  '".date('Y-m-d H:i:s')."', "
    ."`_views` = ".$x
    ." WHERE `muppy_urls`.`_key` = '".$key_data['_key']."';";
    mysql_query($sql)or die("MySQL Error: ".mysql_error());
    db_exit();
    return $key_data['_url'];
}
/**
 * Return last key and generate a new one
 */
function fetch_new_muppy_url($_url){
    global $muppy_conf,$link;
    db_connect();
    if(mysql_num_rows(mysql_query("SELECT `_url` FROM `muppy_urls` WHERE `_url` = '".$_url."'"))){
        $sql = "SELECT * FROM `muppy_urls` WHERE `_url` = '".$_url."'";
        $result=mysql_query($sql)or die("MySQL Error: ".mysql_error());;
        $key_data = mysql_fetch_assoc($result);
        db_exit();
        return $key_data['_key'];
    }else{
        $sql = "SELECT * FROM `muppy_urls` ORDER BY `muppy_urls`.`_id` DESC LIMIT 0, 1 ";
        $result=mysql_query($sql)or die("MySQL Error: ".mysql_error());;
        $key_data = mysql_fetch_assoc($result);
        $new_key=get_next_key($key_data['_key']);
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
                '$new_key',  
                '".$_url."',  
                '".date('Y-m-d H:i:s')."',  
                '".date('Y-m-d H:i:s')."',  
                '0'
                );";
        mysql_query($sql, $link) or die("MySQL Error: ".mysql_error() );
        db_exit();
        return $new_key;
    }
}
/**
 * Return random key
 */
function fetch_random_muppy_url(){
    global $muppy_conf,$link;
    db_connect();
    $offset_result = mysql_query("SELECT FLOOR(RAND() * COUNT(*)) AS `offset` FROM `muppy_urls`");
    $offset_row = mysql_fetch_object($offset_result); 
    $offset = $offset_row->offset;
    $result = mysql_query("SELECT * FROM `muppy_urls` LIMIT $offset, 1");
    $key_data = mysql_fetch_assoc($result);
    db_exit();
    return $key_data['_key']."||".$key_data['_url'];
}
?>
