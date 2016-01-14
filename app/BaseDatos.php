<?php
/*
 * clase para conectar con la base de datos
 */
class BaseDatos
{
    /*private static $host = "tentacionesdeparis.com.mx";
    private static $user = "deparis_user";
    private static $pass = "&3?Sa8XO2Nkv";
	private static $database = "deparis_inventarios";*/
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
	private static $database = "consultorio";
    private static $conn;
    private static $reader;
    private static $res;
    private static $resource;

    public function __construct()
    {
        $this->conectar();
    }

    public static function conectar()
    {
        //crea una nueva conexion a MySQL usando MySQLi
    	self::$conn = new mysqli(self::$host, self::$user, self::$pass, self::$database);
        //self::$conn = mysql_pconnect(self::$host, self::$user, self::$pass);
        if(self::$conn->connect_errno)
        {
            //
            throw new Exception("Error al conectar con la base de datos");
        }
        else 
        {
        	self::$conn->query("SET NAMES utf8");
        }
    }

    public static function liberarResultado()
    {
        //desconectar de la base de datos
        self::$res->free();
    }

    public static function desconectar()
    {
        //desconectar de la base de datos
    	if(!self::$conn->close())
        {
            throw new Exception("Error al desconectar de la base de datos");
        }
        //mysql_close(self::$conn);
    }

    public static function leer($query, $tiposDatos = null, $valores = null)
    {
        //leer de la base de datos
        if(!self::$resource = self::$conn->stmt_init())
        {
            throw new Exception("Error en inicio de una consulta", 1);
            
        }
        if(!self::$resource->prepare($query))
        {
            throw new Exception("Error al preparar un query (".$query.")");
        }

        if(isset($tiposDatos))
        {
            //crear un arreglo de valores y un arreglo para pasar a la funcion bind
            $arregloValores = explode("::", $valores);
            $arregloParaFuncionBind = array();
            //obtener los tipos de datos a insertar: d i s
            $arregloParaFuncionBind[] = &$tiposDatos;

            for($i = 0; $i < count($arregloValores); $i++)
            {
                //obtener los valores a insertar
                $arregloParaFuncionBind[] = &$arregloValores[$i];
            }

            if(!call_user_func_array(array(self::$resource, 'bind_param'), $arregloParaFuncionBind))
            {
                throw new Exception("Error al realizar el bind del parametro");   
            }
        }

        if(self::$resource->execute())
        {
            self::$res = self::$resource->get_result();
        	self::$reader = self::$res->fetch_assoc();
            //self::$reader = mysql_fetch_assoc(self::$resource);
            return self::$reader;
        }
        else
        {
            throw new Exception("Error al ejecutar la consulta: ".self::$conn->error);
        }
    }
    
    public static function insertar($query, $tiposDatos = null, $valores = null)
    {
        //insertar un nuevo registro en la base de datos
        if(!self::$resource = self::$conn->stmt_init())
        {
            throw new Exception("Error en inicio de una consulta");
        }

        if(!self::$resource->prepare($query))
        {
            throw new Exception("Error al preparar un query (".$query.")");
        }
        //echo $tiposDatos;exit();
        //si se envia esta variable se necesita atar valor y variable
        if(isset($tiposDatos))
        {
            //crear un arreglo de valores y un arreglo para pasar a la funcion bind
            $arregloValores = explode("::", $valores);
            $arregloParaFuncionBind = array();
            //obtener los tipos de datos a insertar: d i s
            $arregloParaFuncionBind[] = &$tiposDatos;

            for($i = 0; $i < count($arregloValores); $i++)
            {
                //obtener los valores a insertar
                $arregloParaFuncionBind[] = &$arregloValores[$i];
            }
            //print_r($arregloParaFuncionBind);exit();
            if(!call_user_func_array(array(self::$resource, 'bind_param'), $arregloParaFuncionBind))
            {
                throw new Exception("Error al realizar el bind del parametro");   
            }
        }
        
        if(self::$resource->execute())
        {
            self::$resource->close();
            return 1;
        }
        else
        {
            throw new Exception("Error al ejecutar la consulta: ".self::$conn->error);
            self::$resource->close();
        }
    }
    
    public static function getIdInsertado()
    {
        //obtener el ultimo ID insertado
        return self::$conn->insert_id;
    }
    
    public static function siguienteRegistro()
    {
        //moverse hacia el siguiente elemento
        return self::$reader = self::$res->fetch_assoc();
    }
}