<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/temaDao.php");
include_once("../Entidades/usuario.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();
$tema = new Tema();
$temaDao = new TemaDao($bbdd);
$user = new Usuario();
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)){
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
    $user->setIdUsuario($_GET['idUsuario']);
    $stmt = $temaDao->subirTema($tema, $user);
    if($stmt)
    {
      return http_response_code(200);
    }
    else
    {
      return http_response_code(422);
    }
  }
  return http_response_code(401);
}

?>