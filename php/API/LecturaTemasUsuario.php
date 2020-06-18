<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/temaDao.php");
include_once("../Entidades/usuario.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();

$temaDao = new TemaDao($bbdd);

$temas = [];
$user = new Usuario();
$user->setIdUsuario($_GET['idUsuario']);
$stmt = $temaDao->mostrarTemasUsuario($user);
if($stmt){
  $i = 0;
  while($row = mysqli_fetch_assoc($stmt)){
    $temas[$i]['idTema'] = $row['idTema'];
    $temas[$i]['nombre'] = $row['nombre'];
    $temas[$i]['archivoTema'] = $row['archivoTema'];
    $temas[$i]['nombreArtista'] = $row['nombreArtista'];
    $temas[$i]['duracion'] = $row['duracion'];
    $temas[$i]['valoracion'] = $row['valoracion'];
    $temas[$i]['imagen'] = $row['imagen'];
    $i++;
  }

  echo json_encode($temas);
  return http_response_code(200);
}else{

    return http_response_code(404);
  
}

?>
