<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/usuarioDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();
$user = new Usuario();
$usuarioDao = new UsuarioDao($bbdd);
$usuario = new Usuario();

$idUs = $_GET['idUsuario'];

if($idUs){
    $usuario->setIdUsuario($idUs);
}
$stmt = $usuarioDao->eliminarUsuario($usuario);

if($stmt){
    http_response_code(204);
}
else{
  return http_response_code(422);
}




?>

