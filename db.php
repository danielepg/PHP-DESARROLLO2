<?php 
      $server= "localhost";
      $user = "root";
      $pass = "";
      $db = "alquiler_maquinas";

      $conn = new mysqli ($server,$user,$pass,$db);

      if (!$conn){
        echo "conexion fallida";
      }
?>