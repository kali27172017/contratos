<?php 
namespace  App\Infraestructure;

use App\db\Conexion;

class DashboardRepository extends Conexion{



    public function verifyBirth($nacimiento){
        $bandera = false;
        $birth =  date("Y") - date("Y", strtotime($nacimiento)); 
        
        if( (strtotime($nacimiento)  < strtotime(date("d-m-Y"))) && $birth >=18){
            $bandera = true;   
        }
        return $bandera;    
    }




    public function verifyDni($dni){
       $bandera = true;
        
       $stmt = $this->pdo->prepare("select  * from docente where dni = :dni");
       $stmt->bindParam(':dni',$dni,\PDO::PARAM_STR);
       $stmt->setFetchMode(\PDO::FETCH_ASSOC);
       $stmt->execute();


       if($stmt->rowCount() > 0){
          $bandera = false;
       }
       return $bandera;
    }





    

    public function insertTeacher($data) {

        $msg = [];
        $bandera = true;

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


       $stmt = $this->pdo->prepare("insert into docente(nombre,apellido,dni,fecha_nacimiento,domicilio,id_grado,id_escuela,ciclo_academico,finicio_academico,ffin_academico)
        values(:nombre, :apellido, :dni, :nacimiento, :domicilio, :id_grado, :id_escuela, :ciclo_academico, :inicio_academico, :fin_academico)"); 
         
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


      if(!$this->verifyBirth($nacimiento)){
          $msg = [3,"Fecha Invalida"];
          $bandera = false;   
      }


      if(!$this->verifyDni($dni)){
        $msg = [4,"Dni ya esta Registrado"];
        $bandera = false;
      }


      if($bandera){
        if($stmt->execute()){
            $msg = [1, "correcto"];  
        }
    } 
    
    return $msg;

  }

}  



