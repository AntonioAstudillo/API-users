<?php


require_once 'Mysql.php';

class Usuarios extends Mysql{
   private $nombre;
   private $apellido;
   private $fechaNacimiento;
   private $pais;
   private $conexion;

   function __construct()
   {
      parent::__construct();
      $this->conexion = $this->getConexion();
   }


   public function guardarUsuario($data)
   {
      $query = "INSERT INTO users Values(?,?,?,?,?)";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array(null , $data['nombre'] , $data['apellidos'] , $data['fechaNacimiento'] , $data['pais']  ));

      return $statement->rowCount();
   }

   public function getUsers()
   {
      $query = "SELECT * from users";
      $statement = $this->conexion->prepare($query);
      $statement->execute();

      return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


   public function getUserId($id)
   {
      $query = "SELECT * FROM users WHERE id = ?";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array($id));

      return $statement->fetch(PDO::FETCH_ASSOC);
   }


   public function updateUser($data)
   {
      $query = "UPDATE users SET name = ?  , apellido = ? , fecha = ? , pais = ? WHERE id = ? ";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array($data['nombre'] , $data['apellido'] , $data['fecha'] , $data['pais'] , $data['id'] ));

      return $statement->rowCount();
   }


   public function deleteUser($id)
   {
      $query = "DELETE FROM users WHERE id = ?";
      $statement = $this->conexion->prepare($query);
      $statement->execute(array($id));

      return $statement->rowCount();
   }



}


 ?>
