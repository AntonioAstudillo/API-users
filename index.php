<?php

/*

   Sintaxis universal de las rest api

   crear un usuario               POST     /usuarios
   obtener un usuario             GET      /usuarios{id}
   obtener usuarios               GET      /usuarios
   actualizar un usuario          PUT      /usuarios{id}
   eliminar usuario               DELETE   /usuarios{id}

*/



//require_once 'api/usuarios.php';


if(isset($_GET['url']))
{
   //Al string que nos mandaron, le quitamos el caracter / de la ultima posicion
   $url = rtrim($_GET['url'] , '/' );
   $url = rtrim($_GET['url'] , '\\');

   //limpiamos los valores que nos manden desde la url
   $url = filter_var($url , FILTER_SANITIZE_STRING);

   //Creamos un arreglo utilizando como delimitador el /
   $url = explode('/' , $url);


   //en estos momentos url es un arreglo

   $url[0] = strtolower($url[0]);

   if(isset($url[1]))
   {
      $_GET['id'] = $url[1];
   }


   switch ($url[0]) {
      case 'usuarios':
            require_once 'api/usuarios.php';
         break;
   }
}




 ?>
