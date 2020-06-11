<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/usuarioDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();
$user = new Usuario();
$usuarioDao = new UsuarioDao($bbdd);

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->usuario) === '' && $request->contrasena === '' && $request->email === '' && $request->nombre === '' && $request->apellido1 === '' && $request->apellido2 === '' && $request->fec_nac === '' && $request->pais === '' && $request->telefono === ''){
    return http_response_code(400);
  }else{
    
    $user->setUsuario($request->usuario);
    $user->setContrasena($request->contrasena);
    $user->setEmail($request->email);
    $user->setNombre($request->nombre);
    $user->setApellido1($request->apellido1);
    $user->setApellido2($request->apellido2);
    $user->setFec_nac($request->fec_nac);
    $user->setPais($request->pais);
    $user->setTelefono($request->telefono);
    $existeUsuario = $usuarioDao->comprobarUsuario($user);
    $existeEmail = $usuarioDao->comprobarEmail($user);
    if($existeUsuario > 0 or $existeEmail > 0){
      return http_response_code(409); //Respuesta de conflicto. Usuario ya existe
    }
    $stmt = $usuarioDao->registrarUsuario($user);
  }

  if($stmt){
    $usuario = [
      'usuario' => $user->usuario,
      'contrasena' => $user->contrasena,
      'email' => $user->email,
      'nombre' => $user->nombre,
      'apellido1' => $user->apellido1,
      'apellido2' => $user->apellido2,
      'fec_nac' => $user->fec_nac,
      'pais' => $user->pais,
      'telefono' => $user->telefono
    ];
    echo json_encode($usuario);
    return http_response_code(200);
  }else{
    return http_response_code(422);
  }
}