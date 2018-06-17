<?php
namespace  App\Infraestructure;

use App\db\Conexion;



class ContractRepository extends Conexion{


     public function searchTeacherFound($dni){
        $teacher = [];
        $stmt = $this->pdo->prepare("select  * from docente where dni = :dni ");
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->bindParam(':dni',$dni,\PDO::PARAM_STR);
        $row = $stmt->execute();

        if($row = $stmt->fetch()){
           array_push($teacher,$row);      
        }
        return $teacher;
     }



     public function saveContract($data){

          $docente = (int) $data["dataContract"][0];
          $prestacion = (int) $data["dataContract"][2];

          $stmt = $this->pdo->prepare("insert into contrato(id_prestacion,id_docente) values(:prestacion, :docente)");


          $stmt->bindParam(':prestacion',$prestacion,\PDO::PARAM_INT);
          $stmt->bindParam(':docente',$docente,\PDO::PARAM_INT);
          $stmt->execute();
          return $this->pdo->lastInsertId();

     }

}



