<?php

/**
 * user.php
 *
 * User related class / functions
 *
 * @author Sascha Ohms
 * @copyright Copyright 2011, Sascha Ohms
 * @license http://www.gnu.org/licenses/lgpl.txt
 *
**/

class user extends main {
    public function getHash() {
        if($this->exists('COOKIE.hash'))
            return $this->get('COOKIE.hash');

        return 0;
    }

    public function regUser() {
        $salt = helper::randString();
        $pwd = $ths->pinchOfSalt($this->get('POST.pwd'), null, $salt);
        $hash = helper::randString();

        $ax = new Axon('users');
        $ax->salt = $salt;
        $ax->hash = $hash;
        $ax->email = $this->get('POST.email');
        $ax->name = $this->get('POST.name');
        $ax->regDate = time();
        $ax->pass = $pwd;
        $ax->save();
    }

    public function loginUser() {
        $name = $this->get('POST.name');
        $pwd = $this->get('POST.pwd');

        $ax = new Axon('users');
        $ax->load('name = "' .$name. '" AND pwd = "' .$this->pinchOfSalt($pwd, $name). '"');

        if(!$ax->dry()) {
            $this->set('COOKIE.hash', $ax->hash);
            $this->set('COOKIE.pwd', $ax->pass);

            $this->set('SUCCESS', 'Login success.');
            $this->set('template', 'add.tpl.php');
            $this->tpServe();
        }

        $this->set('ERROR', 'Login failed.');
        $this->set('template', 'login.tpl.php');
        $his->tpServe();
        return false;
    }

    public function validateCookie() {
        if($this->exists('COOKIE.hash') && $this->exists('COOKIE.pwd')) {
            $ax = new Axon('users');
            $ax->load('hash = "'.$this->get('COOKIE.hash'). '" AND pwd = "' .$this->get('COOKIE.pwd'). '"');

            if(!$ax->dry())
                return true;

            return false;
        }
        return false;
    }

    private function pinchOfSalt($pwd, $user = false, $salt = false) {
        if(!$salt) {
            $ax = new Axon('users');
            $ax->load('name = "' .$user. '"');

            if($ax->dry())
                return false;

            $salt = $ax->salt;
        }
        return sha1($pwd.md5($salt));
    }
}

?>