<?php  
/**
* 
*/
class Request
{
    private $_controlador;
    private $_metodo;
    private $_argumentos;


    public function __construct() {
        //si el url no es vacio 
        if ( isset( $_GET['url'] ) ){
            //filtramos url como entrada
            $url = filter_input( INPUT_GET, 'url', FILTER_SANITIZE_URL );
            //generamos un arreglo con los datos de la url
            $url = explode( '/', $url );
            //eliminamos los ///// de mas en la url y generamos una url valida
            $url = array_filter( $url );
            //extraer el primer elemento del array de url
            $this->_controlador = strtolower( array_shift( $url ) );
            //extraemos el primer (segundo elemento) del array de la url
            $this->_metodo = strtolower( array_shift( $url ) );
            //lo que queda son argumentos
            $this->_argumentos = $url;
        }
        
        //si no existe controlador
        if ( !$this->_controlador ) {
            $this->_controlador = DEFAULT_CONTROLLER;
        }
        //si  no existe un metodo 
        if ( !$this->_metodo ) {
            $this->_metodo = 'index';
        }
        //si no hay argumentos
        if ( !isset( $this->_argumentos ) ) {
            $this->_argumentos = array();
        }
    }


    //definimos mas metodos
    public function getControlador(){
        return $this->_controlador;
    }

    public function getMetodo(){
        return $this->_metodo;
    }

    public function getArgs(){
        return $this->_argumentos;
    }
}
?>