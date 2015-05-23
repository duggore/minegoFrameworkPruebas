<?php

class errorController extends Controller
{    
    public function index() {
        $this->display('view/error/noExiste.tpl');
    }
}

?>