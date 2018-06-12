<?php
namespace App\Db;
 

class Conexion {

    public  static $instancia;
    public   $dotenv;
    public  $pdo;

     public  function __construct(){
            //$this->dotenv  = new \Dotenv\Dotenv(__DIR__ .'/../..');
            //$this->dotenv->load();
            
            try{
               $this->pdo = new \PDO("mysql:host=127.0.0.1;dbname=contratos","root","admin");	
            }catch (PDOException $e){
            	echo "Fallo la conexion" . $e->getMessage();
            }
     }

    
     public function  singleton(){
         if(!isset(self::$instancia)){
         	$clase  = __CLASS__;
         	self::$instancia = new $clase;
         }
         return self::$instancia;
     }  

    
    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
} 