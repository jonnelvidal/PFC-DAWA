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
    $usuarios[$i]['idUsuario'] = $row['idUsuario'];
    $usuarios[$i]['usuario'] = $row['usuario'];
    $usuarios[$i]['contrasena'] = $row['contrasena'];
    $usuarios[$i]['email'] = $row['email'];
    $usuarios[$i]['nombre'] = $row['nombre'];
    $usuarios[$i]['apellido1'] = $row['apellido1'];
    $usuarios[$i]['apellido2'] = $row['apellido2'];
    $usuarios[$i]['fec_nac'] = $row['fec_nac'];
    $usuarios[$i]['pais'] = $row['pais'];
    $usuarios[$i]['telefono'] = $row['telefono'];
    $usuarios[$i]['rol'] = $row['rol'];
    $usuarios[$i]['fotoUsuario'] = $row['fotoUsuario'];
    $i++;

  }

  echo json_encode($usuarios);
}else{

  http_response_code(404);
  
}

?>
