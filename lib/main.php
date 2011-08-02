<?php

class main extends F3instance {
    function showAdd() {
        $this->set('template', 'add.tpl.php');
        $this->tpserve();
    }

    function add() {
        $img = new imghost;
        $img->addImg();
    }

    function del() {
        $img = new imghost;
        $img->delImg();
    }

    function showLogin() {
        $this->set('template', 'login.tpl.php');
        $this->tpServe();
    }

    function doLogin() {
        $user = new user;
        $user->loginUser();
    }

    function showRegister() {
        $this->set('template', 'register.tpl.php');
        $this->tpServe();
    }
    
    function tpServe() {
        echo Template::serve('main.tpl.php');
    }

    function start() {
        $this->showAdd();
    }
}

?>