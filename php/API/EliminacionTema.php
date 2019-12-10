<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/temaDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();
$tema = new Tema();
$temaDao = new TemaDao($bbdd);


$idTema = $_GET['idTema'];

if($idTema){
    $tema->setIdTema($idTema);
}
$stmt = $temaDao->eliminarTema($tema);

if($stmt){
    http_response_code(204);
}
else{
  return http_response_code(422);
}




?>

