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
    function crearTablaRelacionalTema(){
        $query = "CREATE TABLE IF NOT EXISTS usuario_tema(
                    idUsuario int(11) NOT NULL,
                    idTema int(11) NOT NULL AUTO_INCREMENT,
                    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario) 
                    ON DELETE CASCADE,
                    FOREIGN KEY (idTema) REFERENCES tema(idTema) 
                    ON DELETE CASCADE
        )";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute(); 
    }
    function subirTema(Tema $tema, Usuario $usuario){
        $query = "INSERT INTO tema(nombre, archivoTema, nombreArtista, duracion, valoracion, imagen) VALUES (?,?,?,?,?,?)";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sssiis", 
                        $tema->nombre,
                        $tema->archivoTema,
                        $tema->nombreArtista,
                        $tema->duracion,
                        $tema->valoracion,
                        $tema->imagen
        );
        $query2 = "INSERT INTO usuario_tema(idUsuario) VALUES (?)";
        $stmt2 = $this->conexion->prepare($query2);
        $stmt2->bind_param("i", $usuario->idUsuario);
        $stmt->execute();
        $stmt2->execute();
        echo "Tema subido";
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
        $stmt->execute();
        echo "Tema actualizado";
    }
    function eliminarTema(Tema $tema){
        $query = "DELETE tema, usuario_tema FROM tema 
        INNER JOIN usuario_tema ON usuario_tema.idTema = tema.idTema 
        WHERE usuario_tema.idTema = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $tema->idTema);
        $stmt->execute();
    }
    function mostrarTemasUsuario(){
        $query = "select tema.nombre, tema.archivoTema, tema.nombreArtista, tema.duracion, tema.valoracion, tema.imagen from tema 
        inner join usuario_tema on tema.idTema = usuario_tema.idTema 
        inner join usuario on usuario_tema.idUsuario = usuario.idUsuario where usuario.idUsuario = 1";
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
$bbdd = new Conexion();
$conexion = $bbdd->getConexion();
$tema = new Tema();
$tema->setIdTema(3);
$usuario = new Usuario();
//$usuario->setIdUsuario(3);

$tema->setNombre("Sarisso");
$tema->setArchivoTema("sarisso.mp3");
$tema->setNombreArtista("D. Marchetto x Sara");
$tema->setDuracion(3);
$tema->setValoracion(10);
$tema->setImagen("SarissaSpear.jpg");

$temaDao = new TemaDao($conexion);
$temaDao->actualizarTema($tema);

?>