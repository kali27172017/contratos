<?php 
namespace  App\Infraestructure;

use App\db\Conexion;


class PanelRepository extends Conexion{

     
     public function listFacultades(){

        $facultades = [];
        $stmt = $this->pdo->prepare("select  * from facultad");
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute();
        
        while($row = $stmt->fetch()){
            array_push($facultades,$row);
        }

        return $facultades;
     
    }




     public function deleteFaculty($id){
        $id = (int)($id);
        $stmt = $this->pdo->prepare("delete facultad.* from facultad as f
        join escuela as e on f.id_facultad = e.id_facultad   where f.id_facultad = :id");
        $stmt->bindParam(':id',$id,\PDO::PARAM_INT);
        return $stmt->execute();   
     }


     /*
      SET FOREIGN_KEY_CHECKS=0;
delete from facultad where id_facultad=1;
delete from escuela where id_facultad=1;
SET FOREIGN_KEY_CHECKS=1;

     */




     
     





}
