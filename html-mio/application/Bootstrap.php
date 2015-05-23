<?php  
/**
* 
*/
class Bootstrap
{
    public static function run( Request $peticion ) {
        
        $controller = $peticion->getControlador() . 'Controller';
        
        $rutaControlador = ROOT . 'controller' . DS . $controller . '.php';
        
        $metodo = $peticion->getMetodo();
        
        $args = $peticion->getArgs();
        
        if(is_readable($rutaControlador)){
            require_once $rutaControlador;
            
            $controller = new $controller;
            
            if(is_callable(array($controller, $metodo))){
                $metodo = $peticion->getMetodo();
            }
            else{
                $metodo = 'index';
            }
            
            if(isset($args)){
                call_user_func_array(array($controller, $metodo), $args);
            }
            else{
                call_user_func(array($controller, $metodo));
            }
            
        } else {
            //throw new Exception('no encontrado');
            $rutaControlador = ROOT . 'controller' . DS . 'indexController.php';
            require_once $rutaControlador;
            
            $metodo = 'error';
            call_user_func_array(array('errorController', $metodo), $args);
        }
    }
}
?>