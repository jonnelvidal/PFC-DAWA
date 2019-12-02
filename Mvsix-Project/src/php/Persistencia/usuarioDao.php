<?php

require("../Entidades/conexion.php");
require("../Entidades/usuario.php");

class UsuarioDao{
    
    private $conexion;
    function crearTablaUsuario(){
        $query = "CREATE TABLE IF NOT EXISTS usuario(
                    idUsuario INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    usuario VARCHAR(50) NOT NULL,
                    contrasena VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    nombre VARCHAR(50) NOT NULL,
                    apellido1 VARCHAR(50) NOT NULL,
                    apellido2 VARCHAR(50),
                    fec_nac DATE,
                    pais VARCHAR(100),
                    telefono INT(11),
                    rol TINYINT DEFAULT 0
        )";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();    
        
    }
    function registrarUsuario(Usuario $usuario){
 
        $query = "INSERT INTO usuario(usuario, contrasena, email, nombre, apellido1, apellido2, fec_nac, pais, telefono) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssssssssi", 
                          $usuario->usuario,
                          $usuario->contrasena, 
                          $usuario->email, 
                          $usuario->nombre, 
                          $usuario->apellido1, 
                          $usuario->apellido2, 
                          $usuario->fec_nac, 
                          $usuario->pais, 
                          $usuario->telefono);
        $stmt->execute();
        echo "Se ha registrado";
    }
    function comprobarUsuario(Usuario $usuario){
        $query = "SELECT * FROM usuario WHERE usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s", $usuario->usuario);
        $stmt->execute();
        $res = $stmt->get_result();
        $usuariosEncontrados = $res->num_rows;
        return $usuariosEncontrados;
    }
    function comprobarEmail(Usuario $usuario){
        $query= "SELECT * FROM usuario WHERE email = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s",$usuario->email);
        $stmt->execute();
        $res = $stmt->get_result();
        $emailEncontrados = $res->num_rows;
        return $emailEncontrados;
    }
    function comprobarCuenta(Usuario $usuario){
        $query = "SELECT usuario, contrasena FROM usuario where usuario = ? and contrasena = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ss", $usuario->usuario, $usuario->contrasena);
        $stmt->execute();
        $res = $stmt->get_result();
        $existeCuenta = $res->num_rows;
        $existeCuenta;
    }
    function infoPerfil(Usuario $usuario){
        $query = "SELECT usuario, email, nombre, apellido1, apellido2, fec_nac, pais, telefono FROM usuario where usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s", $usuario->usuario);
        $stmt->execute();
        foreach($stmt->get_result() as $infoUsuario){
            $usuario->setUsuario($infoUsuario['usuario']);
            $usuario->setEmail($infoUsuario['email']);
            $usuario->setNombre($infoUsuario['nombre']);
            $usuario->setApellido1($infoUsuario['apellido1']);
            $usuario->setApellido2($infoUsuario['apellido2']);
            $usuario->setFec_nac($infoUsuario['fec_nac']);
            $usuario->setPais($infoUsuario['pais']);
            $usuario->setTelefono($infoUsuario['telefono']);
        }
        
        
    }
    function actualizarDatos(Usuario $usuario){
        $query = "CALL actualizarUsuario(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssssssssii", 
                          $usuario->usuario,
                          $usuario->contrasena, 
                          $usuario->email, 
                          $usuario->nombre, 
                          $usuario->apellido1, 
                          $usuario->apellido2, 
                          $usuario->fec_nac, 
                          $usuario->pais, 
                          $usuario->telefono,
                          $usuario->idUsuario
        );
        $stmt->execute();
        echo "Se ha actualizado guay";
    }
    function eliminarUsuario(Usuario $usuario){
        $query = "CALL eliminarUsuario(?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $usuario->idUsuario);
        $stmt->execute();
        echo "Se ha eliminado ese usuario";
    }
    function buscarUsuario(Usuario $usuario){
        $query = "CALL buscarUsuario(?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $usuario->idUsuario);
        $stmt->execute();
        return $stmt->get_result();
        

    }
    function mostrarAmigos(Usuario $usuario){
        $query = "CALL listaAmigos(?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $usuario->idUsuario);
        $stmt->execute();
        return $stmt->get_result();
        
    }
    public function __construct($db){
        $this->conexion = $db;
        $this->crearTablaUsuario();
    }
}

//Funciona registrarUsuario
//Funciona eliminarUsuario
//Funciona actualizarDatos
//Funciona buscarUsuario
//Funciona buscarAmigos
$bbdd = new Conexion();
$conexion = $bbdd->getConexion();
$usuario = new Usuario();
$dao = new UsuarioDao($conexion);

/*
$usuario->setIdUsuario(3);
$usuario->setUsuario("ana.veiga");
$usuario->setContrasena("12345");
$usuario->setEmail("ana.veiga@fwirtz.pfc");
$usuario->setNombre("Ana");
$usuario->setApellido1("Veiga");
$usuario->setApellido2("Noseque");

$stmt = $dao->buscarUsuario($usuario);
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
}*/

?>  




