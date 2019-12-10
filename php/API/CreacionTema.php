<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/temaDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();
$tema = new Tema();
$temaDao = new TemaDao($bbdd);

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if($request->nombre === '' && $request->archivoTema === '' && $request->nombreArtista === '' && $request->duracion === '' && $request->valoracion === '' && $request->imagen === ''){
    return http_response_code(400);
  }else{
    $tema->setNombre($request->nombre);
    $tema->setArchivoTema($request->archivoTema);
    $tema->setNombreArtista($request->nombreArtista);
    $tema->setDuracion($request->duracion);
    $tema->setValoracion($request->valoracion);
    $tema->setImagen($request->imagen);
    $stmt = $temaDao->subirTema($tema);
  }

  if($stmt)
  {
    
    $usuario = [
      'nombre' => $tema->nombre,
      'archivoTema' => $tema->archivoTema,
      'nombreArtista' => $tema->nombreArtista,
      'duracion' => $tema->duracion,
      'valoracion' => $tema->valoracion,
      'imagen' => $tema->imagen
    ];
    echo json_encode($tema);
  }
  else
  {
    http_response_code(422);
  }
}