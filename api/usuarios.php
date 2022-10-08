<?php

header("Content-Type: application/json ");

//Recibimos peticiones del usuario


/*

   Sintaxis universal de las rest api

   crear un usuario               POST     /usuarios
   obtener un usuario             GET      /usuarios{id}
   obtener usuarios               GET      /usuarios
   actualizar un usuario          PUT      /usuarios{id}
   eliminar usuario               DELETE   /usuarios{id}

*/

require_once 'modelos/Usuarios.php';

$peticion = $_SERVER['REQUEST_METHOD'];
$resultado = array();

//creamos un objeto de la clase usuarios para poder hacer las operaciones correspondientes
$objeto = new Usuarios();

switch ($peticion) {
   case 'GET':
      if(isset($_GET['id']))
      {
         $resultado = $objeto->getUserId($_GET['id']);

         if(!$resultado)
         {
            $resultado['respuesta'] = 'No existe ese id';
         }
      }
      else
      {
         $resultado = $objeto->getUsers();

         if(!$resultado)
         {
            $resultado['respuesta'] = 'No hay usuarios registrados';
         }

      }

      echo json_encode($resultado);

      break;
   case 'POST':
      $data = file_get_contents('php://input');
      $data = json_decode($data , true);
      $_POST = $data;

      $respuesta = $objeto->guardarUsuario($_POST);


      if($respuesta > 0)
      {
         $resultado['respuesta'] = 'El usuario se guardo con exito';
      }else{
         $resultado['respuesta'] = 'No pudimos almacenar al usuario';
      }
      echo json_encode($resultado);
   break;
   case 'PUT':
      if(isset($_GET['id']))
      {
         $data = file_get_contents('php://input');
         $data = json_decode($data , true);
         $data['id'] = $_GET['id'];

         if($objeto->updateUser($data) > 0)
         {
            $resultado['respuesta'] = 'El registro se actualizo correctamente';
         }else{
            $resultado['respuesta'] = 'No se pudo actualizar el registro';
         }

         echo json_encode($resultado);
      }

   break;
   case "DELETE":
      if(isset($_GET['id']))
      {

         if($objeto->deleteUser($_GET['id']))
         {
            $resultado['respuesta'] = 'Usuario eliminado con éxito';
         }
         else{
            $resultado['respuesta'] = 'No pudimos eliminar al usuario';
         }

         echo json_encode($resultado);
      }
   break;
}

?>
