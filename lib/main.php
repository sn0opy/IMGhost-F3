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
    
    function tpServe() {
        echo Template::serve('main.tpl.php');
    }

    function start() {
        $this->showAdd();
    }
}

?>