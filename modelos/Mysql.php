<?php


/**
 *  Manejo de la base de datos
 */


//Constantes de configuración
require_once 'Config.php';

class Mysql
{
   private $conexion;

   function __construct()
   {
      $dsn = 'mysql:dbname='.DATABASE.';host='.HOST;

      try{
         $this->conexion = new PDO($dsn , USER , PASSWORD);
         $this->conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $this->conexion->exec('SET NAMES UTF8');
      }catch(PDOException $e){
         echo 'Error 103' . $e->getMessage();
      }
   }

   public function getConexion(){
      return $this->conexion;
   }
}


 ?>
