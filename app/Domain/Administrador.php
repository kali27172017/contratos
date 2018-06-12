<?php
namespace App\Domain;


class Administrador{
    
    private $user;
    private $password;   

    public function __constructor($user,$password){
         $this->user = $user;
         $this->password  = $password;
    }



    public function  getUserAdmin(){
    	 return $this->user;
    }


    public function getPasswordAdmin(){
    	return  $this->password;
    }


}