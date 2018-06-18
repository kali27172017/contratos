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





     public function getInfoBenefit($id_contrato){
         $contract = [];

         $stmt  = $this->pdo->prepare( "select P.tipo_prestacion,D.nombre,D.apellido,D.dni,D.domicilio,
          D.finicio_academico,D.ffin_academico,D.ciclo_academico,
          (select nombre_escuela  from escuela  where id_escuela=D.id_escuela) as nom_escuela,
          (select F.nombre_facultad from facultad as F join escuela as E on
          F.id_facultad=E.id_facultad where E.id_escuela=D.id_escuela) as nom_facultad
          from contrato as C  
          join prestacion as P on
          C.id_prestacion=P.id_prestacion 
          join docente as D  on C.id_docente=D.id_docente
          where C.id_contrato=:id_contrato");
         
         $stmt->setFetchMode(\PDO::FETCH_ASSOC);
         $stmt->bindParam(':id_contrato',$id_contrato,\PDO::PARAM_INT);
         $row = $stmt->execute();


         if($row = $stmt->fetch()){
             array_push($contract,$row);
         }
         return $contract;

       }

}



