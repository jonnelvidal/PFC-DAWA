<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require("../Entidades/conexion.php");
require("../Entidades/tema.php");
require("../Entidades/usuario.php");


class TemaDao{
    
    private $conexion;
    
    function crearTablaTema(){
        $query= "CREATE TABLE IF NOT EXISTS tema(
                    idTema INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    nombre VARCHAR(50) NOT NULL,
                    archivoTema VARCHAR(255) NOT NULL,
                    nombreArtista VARCHAR(50) NOT NULL,
                    duracion DOUBLE(3,2) NOT NULL,
                    valoracion INT(11),
                    imagen VARCHAR(255),
                    idUsuario INT NOT NULL FOREIGN KEY(idUsuario) 
                    REFERENCES usuario(idUsuario) ON DELETE CASCADE
        )";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        
    }
    function subirTema(Tema $tema, Usuario $usuario){
        $query = "INSERT INTO tema(nombre, archivoTema, nombreArtista, duracion, valoracion, imagen, idUsuario) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sssiisi", 
                        $tema->nombre,
                        $tema->archivoTema,
                        $tema->nombreArtista,
                        $tema->duracion,
                        $tema->valoracion,
                        $tema->imagen,
                        $usuario->idUsuario
        );
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function actualizarTema(Tema $tema, Usuario $usuario){
        $query = "UPDATE tema SET nombre = ?, archivoTema = ?, nombreArtista = ?, duracion = ?, valoracion = ?, imagen = ? WHERE idTema = ? AND idUsuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssssisii",
                        $tema->nombre,
                        $tema->archivoTema,
                        $tema->nombreArtista,
                        $tema->duracion,
                        $tema->valoracion,
                        $tema->imagen,
                        $tema->idTema,
                        $usuario->idUsuario
        );
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        
    }
    function eliminarTema(Tema $tema, Usuario $usuario){
        $query = "DELETE FROM tema WHERE idTema = ? and idUsuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ii", $tema->idTema, $usuario->idUsuario);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function mostrarTemasUsuario(Usuario $usuario){
        $query = "SELECT * FROM tema WHERE idUsuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $usuario->idUsuario);
        $stmt->execute();
        return $stmt->get_result();

    }
    function temaSeleccionado(Tema $tema){
        $query = "SELECT nombre, archivoTema, nombreArtista, duracion, valoracion, imagen FROM tema WHERE idTema = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $tema->idTema);
        $stmt->execute();
        $res = $stmt->get_result();
        echo $res->num_rows;
        /*foreach($res as $datosTema){
            $tema->setNombre($datosTema['nombre']);
            $tema->serArchivoTema($datosTema['archivoTema']);
            $tema->setNombreArtista($datosTema['nombreArtista']);
            $tema->setDuracion($datosTema['duracion']);
            $tema->setValoracion($datosTema['valoracion']);
            $tema->setImagen($datosTema['imagen']);
        }*/
    }
    public function __construct($db){
        $this->conexion = $db;
        $this->crearTablaTema();
        $this->crearTablaRelacionalTema();
    } 
    
}
//subirTema funciona
//temaSeleccionado funciona
//eliminarTema funciona
//actualizar tema funciona


?>