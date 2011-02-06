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
require_once('muppy-includes/config.php');
require_once('muppy-includes/functions.php');
require_once('muppy-includes/db-setup.php');
require_once('muppy-includes/uri-processor.php');
?>
<!DOCTYPE HTML> 
<html> 
    <head>
        <meta charset="utf-8"> 
        <title><?php echo $muppy_conf['site_title'] ?></title>
        <link rel="shortcut icon" href="<?php echo $muppy_conf['site_url'] ?>favicon.ico"> 
        <link rel="stylesheet" href="<?php echo $muppy_conf['site_url'] ?>style.css" type="text/css"> 
    </head>
    <body>
    <header>
       <div class="masthead">
           <h1><?php echo $muppy_conf['site_title'] ?></h1>
       </div>  
    </header>
    <article>
        <div class="content">
           <?php if(isset($new_url)){?>
           <p class="newurl">Your new short URL is: <a href="<?php echo $new_url; ?>" target="_blank"><?php echo $new_url; ?></a></p>
           <?php }else{?>
           <h2>About</h2>
           <p><?php echo $muppy_conf['site_title'] ?> is <a href="<?php echo $muppy_conf['homepage'] ?>" title="<?php echo $muppy_conf['fullname'] ?>'s homepage."><?php echo $muppy_conf['fullname'] ?>'s</a> personal URL shortening service.</p>
           <?php } ?>
       </div>
    </article>
    <footer>
        <div class="footer">
           <p><?php echo $muppy_conf['site_title'] ?> is powered by <a href="http://corenominal.org/muppy-project/" title="Muppy Project">Muppy</a>, URL shortening software derived from <a href="http://ur1.ca/" title="ur1.ca">ur1</a>.<br>Full <a href="http://corenominal.org/muppy-project/download/" title="Download Muppy">source available</a> under the terms of the <a href="http://www.gnu.org/licenses/gpl.html" title="View the GNU General Public License.">GNU General Public License</a>.</p>
       </div>
    </footer>
    </body>
</html>
