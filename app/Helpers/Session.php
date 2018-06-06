<?php
namespace App\Helpers;

class Session {

      public static function sessionUSer($post){   
           $_SESSION["admin"] = $post["admin"];
           $_SESSION["clave"] = $post["clave"];
      }


      public static function destroy(){
           session_unset();
           session_destroy();
      }

}
