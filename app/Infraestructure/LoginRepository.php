<?php
namespace App\Infraestructure;

use App\db\Conexion;


class LoginRepository extends Conexion{
    
     public $admin;
     public $clave;
     public  $data;


     public function setAdmin($admin){
     	 $this->admin = $admin;
     }


     public function getAdmin(){
     	 return $this->admin;
     }

     
     public function setClave($clave){
     	$this->clave = $clave;
     }


     public function  getClave(){
     	 return $this->clave;
     }


     public  function validateResponse($data){
     	 $this->setAdmin($data["admin"]);
     	 $this->setClave($data["clave"]);

     	 $admin = $this->getAdmin();
         $password = $this->getClave();
         return $this->compareToUser($admin,$password);
     }



       public function  compareToUser($admin,$password){

       	 $bandera  = [];
         $stmt = $this->pdo->prepare("select  * from administrador where user_admin = :admin and  password_admin = :clave" );
         $stmt->setFetchMode(\PDO::FETCH_ASSOC);
         $stmt->bindParam(':admin',$admin);
         $stmt->bindParam(':clave',$password);
         $stmt->execute();

         if($row = $stmt->fetch()){
            if($row["user_admin"]==$admin && $row["password_admin"]==$password){
                    $bandera = ['fa-check','check',true];                
            } 
         }else{

            	    $bandera = ['fa-times','cross',false];
         }

         return $bandera;   
       }
}