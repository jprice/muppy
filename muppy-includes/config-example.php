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
 * Settings array.
 */
$muppy_conf = array(
    'site_url'            =>   'http://example.org/',
    'site_title'          =>   'Example Site',
    'fullname'            =>   'Joe Bloggs',
    'email'               =>   'username@example.org',
    'api_key'             =>   '68b329da9893e34099c7d8ad5cb9c940',
    'db_name'             =>   'database_name',
    'db_address'          =>   'localhost',
    'db_username'         =>   'username',
    'db_password'         =>   'password',
    'server_timezone'     =>   'UTC',
    'html_lang'           =>   'en',
    'charset'             =>   'utf-8'
);
/**
 * --------------------------------------------------*
 * YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE! *
 * --------------------------------------------------*
 */
/**
 * Set server date/time as defined in includes/config.php
 * See: http://www.php.net/manual/en/timezones.php for a list
 * of supported timezones.
 */
if ($muppy_conf['server_timezone'] != ''){
    date_default_timezone_set($muppy_conf['server_timezone']);
}
?>
