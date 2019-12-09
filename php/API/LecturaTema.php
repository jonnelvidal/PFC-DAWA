<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/temaDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();

$temaDao = new TemaDao($bbdd);

$stmt = $temaDao->mostrarTemasUsuario();
/* Se crea un array usuarios que se utilizará para obtener los datos en Angular */
$temas = [];

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
}else{

  http_response_code(404);
  
}

?>
