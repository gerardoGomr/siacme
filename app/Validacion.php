<?php
/**
 * CLASE PARA VALIDACION DE ENTEROS, CADENAS, FLOTANTES, NO_SQL
 */

abstract class Validacion
{
	//string
	protected $valor;
	//bool
	public function validaVacio($cadena)
	{
		//devuleve true si la cadena esta vacia
		return empty($cadena);
	}
	//bool
	public function validaEntero($numero)
	{
		//validar que el numero sea numero entero
		return is_numeric($numero);
	}
	//bool
	public function validaFlotante($numero)
	{
		//validar que el numero sea numero flotante
		$numeroConExplode = explode(".", $numero);
		if(!empty($numeroConExplode))
			return true;
		
		return false;
	}
	//bool
	public function validaCorreo($correo)
	{
		//validar que el correo tenga un formato válido
		if(preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/", $correo))   
			return true;   
		
		return false;
	}
	
	//bool
	public function validaTelefono($telefono)
	{
		if(preg_match("/^[0-9]+$/", $telefono))   
			return true;   
		
		return false;
	}
	
	//bool, generalmente para validacion GET o POST
	public function validaNoSQL($cadena)
	{
		$cadenaTemporal = strip_tags($cadena);
		$cadenaTemporal = ereg_replace('"', "", $cadenaTemporal);
		$cadenaTemporal = ereg_replace("'", "", $cadenaTemporal);
		$cadenaTemporal = ereg_replace('%', "", $cadenaTemporal);
		$cadenaTemporal = ereg_replace('<', "", $cadenaTemporal);
		$cadenaTemporal = ereg_replace('>', "", $cadenaTemporal);
		$cadenaTemporal = ereg_replace('%20', "", $cadenaTemporal);
		
		if($cadena != $cadenaTemporal)
			return true;  //Contiene codigo malicioso
		else
			return false;
	}

	//funcion para colocar comillas dobles o simples al valor especificado
    function limpiarValores($theValue) 
    {
        if (PHP_VERSION < 6) 
        {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }
        
        //$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
		
		$search = array("\x00", "\n", "\r", '\\', "'", '"', "\x1a");
		$replace = array('\x00', '\n', '\r', '\\\\' ,"\'", '\"', '\x1a');
		
		$theValue = str_replace($search, $replace, $theValue);
        return $theValue;
    }


    //funcion para escapar variables
    function escaparAtributo($theValue, $tipo, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        if (PHP_VERSION < 6) 
        {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }
        
        //$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
		
		$search = array("\x00", "\n", "\r", '\\', "'", '"', "\x1a");
		$replace = array('\x00', '\n', '\r', '\\\\' ,"\'", '\"', '\x1a');
		
		$theValue = str_replace($search, $replace, $theValue);
        
        switch ($tipo) 
        {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;    
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }

        return $theValue;
    }
}
