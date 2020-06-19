<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/usuarioDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();
$user = new Usuario();
$usuarioDao = new UsuarioDao($bbdd);
$idUs = explode(":",$_GET['idUsuarios']);
$stmt = $usuarioDao->agregarAmigo($idUs[0] ,$idUs[1]);
if($stmt){
    return http_response_code(200);
}
else{
  return http_response_code(422);
}




?>

