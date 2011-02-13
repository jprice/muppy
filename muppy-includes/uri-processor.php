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
$uri = explode(",", process_uri($_SERVER['REQUEST_URI']));
$_key = substr($uri[0],1);
/**
 * Perform key lookup and if required, do redirection
 */
if($uri[1]==1 && !ereg('[^a-z0-9]', $_key)){
    //perform db lookup and redirect if found
    if(db_key_lookup($_key)){
        
        //update record and return long url
        $longURL=fetch_muppy_url($_key);
        
        //redirect
        header("Location: ".$longURL);
        exit;
    }
}
/**
 * Perform URL shortening
 */
if(isset($_GET['api_key']) && $_GET['api_key']==$muppy_conf['api_key']){
    if(isset($_GET['url'])){
        $_SESSION['new_url']=$muppy_conf['site_url'].fetch_new_muppy_url($_GET['url']);
        if(!isset($_GET['output'])){
            $output='html';
        } else {
            $output=$_GET['output'];
        }
        switch ($output) {
            case 'plain':
                header("Content-Type: text/plain");
                echo $_SESSION['new_url'];
                unset($_SESSION['new_url']);
                exit;
                break;
            case 'json':
                $arr = array('longurl'=>$_GET['url'],'shorturl'=>$_SESSION['new_url']);
                header('Content-Type: application/json');
                header('Access-Control-Allow-Origin: *');
                /**
                 * str_replace bug? See: http://muppy.org/h
                 */
                echo str_replace('\\/', '/', json_encode($arr));
                unset($_SESSION['new_url']);
                exit;
                break;
            case 'xml':
                header('Content-Type: text/xml');
                echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
                echo '  <muppy>'."\n";
                echo '      <longurl>'.$_GET['url'].'</longurl>'."\n";
                echo '      <shorturl>'.$_SESSION['new_url'].'</shorturl>'."\n";
                echo '  </muppy>';
                unset($_SESSION['new_url']);
                exit;
                break;
            case 'html':
                header("Location: ".$muppy_conf['site_url']);
                exit;
                break;
        }
    }
}
?>
