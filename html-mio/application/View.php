<?php  
require 'libs/Smarty.class.php';
/**
* 
*/
class View extends Smarty
{
    public $vista;

    function __construct()
    {
        $this->vista = new Smarty;
    }
}
?>