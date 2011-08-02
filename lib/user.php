<?php

/**
 * user.php
 *
 * User related class / functions
 *
 * @package Index
 * @author Sascha Ohms
 * @copyright Copyright 2011, Sascha Ohms
 * @license http://www.gnu.org/licenses/lgpl.txt
 *
**/

class user extends F3instance {
    public function getUserId() {
        if($this->exists('COOKIE.userId'))
            return $this->get('COOKIE.userId');

        return 0;
    }
}

?>