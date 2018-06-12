<?php
namespace App\Infraestructure;

use App\db\Conexion;

class EscuelaRepository extends Conexion{

   public function listEscuelas(){
   	    $escuelas = [];
     	$stmt  = $this->pdo->prepare("select  * from escuela");
     	$stmt->setFetchMode(\PDO::FETCH_ASSOC);
     	$stmt->execute();
        
        while($row = $stmt->fetch()){
           array_push($escuelas,$row);
        }
          return $escuelas;
   }

}
