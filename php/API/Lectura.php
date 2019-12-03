<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("../Persistencia/usuarioDao.php");

$conexion = new Conexion();
$bbdd = $conexion->getConexion();

$usuarioDao = new UsuarioDao($bbdd);

$stmt = $usuarioDao->mostrarUsuarios();
$num = $stmt->num_rows;
echo $num;
if($num>0){

    $produtos_arr=array();
    $produtos_arr["records"]=array();
    while ($item=$stmt->fetch_assoc()){
        $item_produto=array(
            
            "Nombre:" => $item["nombre"],
            "Primer apellido:" => $item["apellido1"],
            "Segundo apellido:" => $item["apellido2"],
            
        );
        array_push($produtos_arr["records"],$item_produto);
    }
    http_response_code(200);

    echo json_encode($produtos_arr,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

?>
