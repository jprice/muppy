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
$view = substr($uri[0],1);

echo "<pre>";
echo "**debug**: view=$view\n";
echo "**debug**: uri[1]=$uri[1]\n";
echo "**debug** api_key: ".$_GET['api_key']."\n";

//url lookup and redirection



//url shortening condition
if(isset($_GET['api_key']) && $_GET['api_key']==$muppy_conf['api_key']){
    if(isset($_GET['url'])){
        echo "**debug** api_key: ".$muppy_conf['api_key']."\n";
        echo "**debug** api_key: ".$_GET['url']."\n";
        //do shortening URL
    }
}
echo "</pre>";
?>
