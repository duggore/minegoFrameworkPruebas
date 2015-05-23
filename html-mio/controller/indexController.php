<?php  
/**
* 
*/
class IndexController extends View
{
    public function index(){
        $this->vista->display('view/principal/index.tpl');
    }

    public function error(){
        $this->vista->display('view/principal/index.tpl');
    }
}
?>