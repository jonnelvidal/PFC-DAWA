<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/playlistDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();

$playlistDao = new PlaylistDao($bbdd);

$stmt = $playlistDao->mostrarPlaylist();

$playlist = [];

if($stmt){

  $i = 0;
  while($row = mysqli_fetch_assoc($stmt)){
    $playlist[$i]['idPlaylist'] = $row['idPlaylist'];
    $playlist[$i]['idUsuario'] = $row['idUsuario'];
    $playlist[$i]['nombrePlaylist'] = $row['nombrePlaylist'];
    $playlist[$i]['imagen'] = $row['imagen'];
    
    $i++;

  }

  echo json_encode($playlist);
}else{

  http_response_code(404);
  
}

?>
