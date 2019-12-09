<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/usuarioDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();
$usuarioDao = new UsuarioDao($bbdd);
$user = new Usuario();
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)){

  $request = json_decode($postdata);

  if(trim($request->usuario) === '' && $request->contrasena === ''){
    return http_response_code(400);
  }else{
    $user->setUsuario($request->usuario);
    $user->setContrasena($request->contrasena);
  }
  if($usuarioDao->comprobarCuenta($user)){
    $userInfo = $usuarioDao->infoPerfil($user);
    $usuario = [
      'idUsuario' => $userInfo->idUsuario,
      'usuario' => $userInfo->usuario,
      'contrasena' => $userInfo->contrasena,
      'email' => $userInfo->email,
      'nombre' => $userInfo->nombre,
      'apellido1' => $userInfo->apellido1,
      'apellido2' => $userInfo->apellido2,
      'fec_nac' => $userInfo->fec_nac,
      'pais' => $userInfo->pais,
      'telefono' => $userInfo->telefono
    ];
    echo json_encode($usuario);
  }else{
    return http_response_code(422);
  }
}

?>
