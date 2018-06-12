<?php
namespace App\Infraestructure;

use App\db\Conexion;

 class GradoRepository extends Conexion{
  
      
     public function listGrados(){
     	$grados = [];
     	$stmt  = $this->pdo->prepare("select  * from grado");
     	$stmt->setFetchMode(\PDO::FETCH_ASSOC);
     	$stmt->execute();
        
        while($row = $stmt->fetch()){
           array_push($grados,$row);
        }
          return $grados;
     }

 }
 