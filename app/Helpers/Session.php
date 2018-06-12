<?php
namespace App\Helpers;

class Session {

      public static function sessionUSer($post){   
           $_SESSION['administrador'] = $post["admin"];
           $_SESSION['password'] = $post["clave"];
      }


      public static function destroy(){
           session_unset();
           session_destroy();
      }

}
