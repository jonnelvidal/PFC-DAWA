<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require("../Entidades/conexion.php");
require("../Entidades/playlist.php");
require("../Entidades/usuario.php");

class PlaylistDao{
    function crearPlaylist(Playlist $playlist){
        $query = "INSERT INTO playlist(nombrePlaylist, imagen) VALUES (?,?)"; //prueba sin idUsuario
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $playlist->nombrePlaylist, $playlist->imagen);
        $stmt->execute();
    }
    function actualizarPlaylist(Playlist $playlist){
        $query = "UPDATE playlist set nombrePlaylist = ? where idPlaylist = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $playlist->nombrePlaylist, $playlist->idPlaylist);
        $stmt->execute();
    }
    function eliminarPlaylist(Playlist $playlist){
        $query = "DELETE FROM playlist where idPlaylist = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $playlist->idPlaylist);
        $stmt->execute();
    }
    public function __construct($db){
        $this->conexion = $db;
    }
    function mostrarPlaylist(){
        $query = "SELECT * FROM playlist";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
}

?>