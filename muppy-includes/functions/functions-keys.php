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
 * The following functions are borrowed and modified from lilURL
 * See: http://lilurl.sourceforge.net/
 */

function get_next_key($last_key){
    if ( $last_key == -1 ){
        $next_key = 0;
    } else {
        for ( $x = 1; $x <= strlen($last_key); $x++ ){
            $pos = strlen($last_key) - $x;
            if ( $last_key[$pos] != 'z' ){
                $next_key = increment_id($last_key, $pos);
                break;
            }
        }
        if ( !isSet($next_key) ){
            $next_key = append_id($last_key);
        }
    }
    return $next_key;
}
function append_id($id){
    for ( $x = 0; $x < strlen($id); $x++ ){
        $id[$x] = 0;
    }
    $id .= 0;
    return $id;
}
function increment_id($id, $pos){
    $char = $id[$pos];
    if ( is_numeric($char) ){
        if ( $char < 9 ){
            $new_char = $char + 1;
        } else {
            $new_char = 'a';
        }
    } else {
        $new_char = chr(ord($char) + 1);
    }
    $id[$pos] = $new_char;
    if ( $pos != (strlen($id) - 1) ){
        for ( $x = ($pos + 1); $x < strlen($id); $x++ ){
            $id[$x] = 0;
        }
    }
    return $id;
}
?>
