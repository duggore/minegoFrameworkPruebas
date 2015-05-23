<?php

/*
 * -------------------------------------
 * www.dlancedu.com | Jaisiel Delance
 * framework mvc basico
 * Controller.php
 * -------------------------------------
 */
include "libs/Smarty.class.php";

abstract class Controller extends Smarty
{
    //public $smarty;
    
    public function __construct() {
        $this->smarty = new Smarty;
    }
    
    abstract public function index();
}

?>
