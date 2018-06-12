<?php 
namespace  App\Infraestructure;

use App\db\Conexion;

class DashboardRepository extends Conexion{


   public function insertTeacher($data) {
        

    

        $nombre = $data["dataRegister"][0];
        $apellido = $data["dataRegister"][1];
        $dni = $data["dataRegister"][2];
        $nacimiento = $data["dataRegister"][3];
        $domicilio = $data["dataRegister"][4];
        $id_grado =  $data["dataRegister"][5];
        $id_escuela = $data["dataRegister"][6];
        $ciclo_academico = $data["dataRegister"][7];
        $inicio_academico = $data["dataRegister"][8];
        $fin_academico = $data["dataRegister"][9];


       $stmt = $this->pdo->prepare("insert into docente(nombre,apellido,dni,fecha_nacimiento,domicilio,id_grado,id_escuela,ciclo_academico,finicio_academico,ffin_academico) values(:nombre, :apellido, :dni, :nacimiento, :domicilio, :id_grado, :id_escuela, :ciclo_academico, :inicio_academico, :fin_academico)"); 
         
       $stmt->bindParam(':nombre',$nombre,\PDO::PARAM_STR);
       $stmt->bindParam(':apellido',$apellido,\PDO::PARAM_STR);
       $stmt->bindParam(':dni',$dni,\PDO::PARAM_STR);
       $stmt->bindParam(':nacimiento',$nacimiento,\PDO::PARAM_STR);
       $stmt->bindParam(':domicilio',$domicilio,\PDO::PARAM_STR);
       $stmt->bindParam(':id_grado',$id_grado,\PDO::PARAM_STR);
       $stmt->bindParam(':id_escuela',$id_escuela,\PDO::PARAM_STR);
       $stmt->bindParam(':ciclo_academico',$ciclo_academico,\PDO::PARAM_STR);
       $stmt->bindParam(':inicio_academico',$inicio_academico,\PDO::PARAM_STR);
       $stmt->bindParam(':fin_academico',$fin_academico,\PDO::PARAM_STR);
       
       if($stmt->execute()){
       	   return "correcto";
       }else{
       	    return "error";
       }
   }



}



