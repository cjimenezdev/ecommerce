<?php

/*----------  Datos del servidor  ----------*/
	const SERVER="127.0.0.1:3307";
	const DB="williams";
	const USER="root";
	const PASS="";


	const SGBD="mysql:host=".SERVER.";dbname=".DB;


	/*----------  Datos de la encriptacion (No modificar) ----------*/
	const METHOD="AES-256-CBC";
	const SECRET_KEY='$WILL@2022';
	const SECRET_IV='102791';


	class ApptivaDB{    
    private $host   = SERVER;
    private $usuario= USER;
    private $clave  = PASS;
    private $db     = DB;
    public $conexion;
    public function __construct(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave,$this->db) or die(mysql_error());
        $this->conexion->set_charset("utf8");
    }

	public function buscar($tabla, $condicion){
        $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
        if($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    }
}