<?php

/**
 * helper.php
 *
 * helper functions
 *
 * @author Sascha Ohms
 * @copyright Copyright 2011, Sascha Ohms
 * @license http://www.gnu.org/licenses/lgpl.txt
 *
**/

class helper extends F3instance {
    public function randString() {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
    }
}

?>