<?php

class main extends F3instance {
    function showAdd() {
        F3::set('template', 'add.tpl.php');
        self::tpserve();
    }

    function add() {
        $img = new imghost;
        $img->addImg();
    }
    
    function tpServe() {
        echo Template::serve('main.tpl.php');
    }

    function start() {
        F3::reroute('add');
    }
}

?>