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
                    imagen VARCHAR(255)
        )";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
    }
    
    function subirTema(Tema $tema, Usuario $usuario){
        $query = "INSERT INTO tema(nombre, archivoTema, nombreArtista, duracion, valoracion, imagen) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sssiis", 
                        $tema->nombre,
                        $tema->archivoTema,
                        $tema->nombreArtista,
                        $tema->duracion,
                        $tema->valoracion,
                        $tema->imagen
        );
        
        if($stmt->execute()){
            $idTemaInsertado = mysql_query("SELECT LAST_INSERT_ID()");
            $query2 = "INSERT INTO usuario_tema(idUsuario, idTema) VALUES (?,?)";
            $stmt2 = $this->conexion->prepare($query2);
            $stmt2->bind_param("ii",
                $usuario->idUsuario,
                $idTemaInsertado
            );
            if($stmt2->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    function actualizarTema(Tema $tema){
        $query = "UPDATE tema SET nombre = ?, archivoTema = ?, nombreArtista = ?, duracion = ?, valoracion = ?, imagen = ? WHERE idTema = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssssisi",
                        $tema->nombre,
                        $tema->archivoTema,
                        $tema->nombreArtista,
                        $tema->duracion,
                        $tema->valoracion,
                        $tema->imagen,
                        $tema->idTema
        );
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        
    }
    function eliminarTema(Tema $tema){
        $query = "DELETE FROM tema WHERE idTema = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $tema->idTema);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function mostrarTemasUsuario(){
        $query = "SELECT * FROM tema 
        t INNER JOIN usuario_tema ut ON ut.idTema = t.idTema WHERE ut.idUsuario = 4";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
    function temaSeleccionado(Tema $tema){
        $query = "SELECT t.nombre, t.archivoTema, t.nombreArtista, t.duracion, t.valoracion, t.imagen FROM tema 
t INNER JOIN usuario_tema ut ON ut.idTema = t.idTema WHERE ut.idUsuario = 4";
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
        //$this->crearTablaRelacionalTema();
    } 
    
}
//subirTema funciona
//temaSeleccionado funciona
//eliminarTema funciona
//actualizar tema funciona


?>