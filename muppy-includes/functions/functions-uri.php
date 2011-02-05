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
function process_uri($s){
    global $muppy_conf;
    $n = $muppy_conf['site_url'];
    $lc = substr($n, -1);
    if($lc == "/"){
        $n = substr($n, 0, -1);
    }
    $sp = strrpos($n,"/");
    $n = substr($n, $sp+1);
    $lc = substr($s, -1);
    if($lc != "/"){
        $s = $s."/";
    }
    if (strpos($s, $n)){
        $s = substr($s,strpos($s, $n)
                  +strlen($n),strlen($s));
    }
    $s = substr($s,0,strlen($s)-1);
    $c = substr_count($s, '/');
    return($s.",".$c);
}
?>
