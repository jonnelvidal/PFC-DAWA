<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require("../Entidades/conexion.php");
require("../Entidades/publicacion.php");
require("../Entidades/usuario.php");

class PublicacionDao{

    function crearTablaPublicacion(){
        $query = "CREATE TABLE IF NOT EXISTS publicacion(
                    idPublicacion INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    titulo VARCHAR(100) NOT NULL,
                    descripcion VARCHAR(255) NOT NULL,
                    fecha_publicacion DATE,
                    valoracion INT(11)
        )";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
    }
    function crearTablaRelacionalPublicacion(){
        $query = "CREATE TABLE IF NOT EXISTS usuario_publicacion(
                    idUsuario int(11) NOT NULL,
                    idPublicacion int(11) NOT NULL AUTO_INCREMENT,
                    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario) 
                    ON DELETE CASCADE,
                    FOREIGN KEY (idPublicacion) REFERENCES publicacion(idPublicacion) 
                    ON DELETE CASCADE
        )";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute(); 
    }
    function subirPublicacion(Publicacion $publicacion, Usuario $usuario){
        $query  = "INSERT INTO publicacion(titulo, descripcion, fecha_publicacion, valoracion) VALUES (?,?,NOW(),?)
        ";
        $query2 = "INSERT INTO usuario_publicacion(idUsuario) VALUES (?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssi", 
                        $publicacion->titulo, 
                        $publicacion->descripcion, 
                        $publicacion->valoracion      
        ); 
        $stmt2 = $this->conexion->prepare($query2);
        $stmt2->bind_param("i", $usuario->idUsuario);
        $stmt->execute();
        $stmt2->execute();
    }
    
    function actualizarPublicacion(Publicacion $publicacion){
        $query = "UPDATE publicacion SET titulo = ?, descripcion = ?, fecha_publicacion = NOW(), valoracion = ? WHERE idPublicacion = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssii",
                        $publicacion->titulo, 
                        $publicacion->descripcion, 
                        $publicacion->valoracion,
                        $publicacion->idPublicacion
        );
        $stmt->execute();
    }
    
    function eliminarPublicacion(Publicacion $publicacion){
        $query = "DELETE publicacion, usuario_publicacion FROM publicacion 
        INNER JOIN usuario_publicacion ON usuario_publicacion.idPublicacion = publicacion.idPublicacion 
        WHERE usuario_publicacion.idPublicacion = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $publicacion->idPublicacion);
        $stmt->execute();
    }
    function seleccionarPublicacion(Publicacion $publicacion){
        $query = "SELECT * FROM publicacion WHERE idPublicacion = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i",$publicacion->idPublicacion);
        $stmt->execute();
        $res = $stmt->get_result();
        echo $res->num_rows;
    }
    function procedureMama(Publicacion $publicacion){
        $query = "CALL buscarUsuario(?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $publicacion->idPublicacion);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->num_rows;

    }
    public function __construct($db){
        $this->conexion = $db;
        $this->crearTablaPublicacion();
        $this->crearTablaRelacionalPublicacion();
    }
    
    
}


?>
