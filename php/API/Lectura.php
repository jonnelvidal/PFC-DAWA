<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/usuarioDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();

$usuarioDao = new UsuarioDao($bbdd);

$stmt = $usuarioDao->mostrarUsuarios();
/* Se crea un array usuarios que se utilizará para obtener los datos en Angular */
$usuarios = [];

if($stmt){

  $i = 0;
  while($row = mysqli_fetch_assoc($stmt)){
    $usuarios[$i]['idUsuario']    = $row['idUsuario'];
    $usuarios[$i]['nombre'] = $row['nombre'];
    $usuarios[$i]['apellido1'] = $row['apellido1'];
    $i++;

  }

  echo json_encode($usuarios);
}else{

  http_response_code(404);
  
}

?>
