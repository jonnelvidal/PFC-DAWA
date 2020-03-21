<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require("../Entidades/conexion.php");
require("../Entidades/playlist.php");
require("../Entidades/usuario.php");

class PlaylistDao{
    function crearPlaylist(Playlist $playlist, Usuario $usuario){
        $query = "INSERT INTO playlist(nombrePlaylist, imagen, idUsuario) VALUES (?,?,?)"; //Usuario crea una Playlist y se le asigna su id
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $playlist->nombrePlaylist, $playlist->imagen, $usuario->idUsuario);
        $stmt->execute();
    }
    function actualizarPlaylist(Playlist $playlist, Usuario $usuario){
        $query = "UPDATE playlist set nombrePlaylist = ? where idPlaylist = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $playlist->nombrePlaylist, $playlist->idPlaylist);
        $stmt->execute();
    }
    function eliminarPlaylist(Playlist $playlist, Usuario $usuario){
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
    function mostrarMisPlaylist(Usuario $usuario){
        $query = "SELECT * FROM playlist WHERE idUsuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $usuario->idUsuario);
        $stmt->execute();
        return $stmt->get_result();
    }
    function seguirPlaylist(Playlist $playlist, Usuario $usuario){
        $query = "INSERT INTO sigue_playlist(idPlaylist, idUsuario) VALUES (?,?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ii, $playlist->idPlaylist, $usuario->idUsuario");
        $stmt->execute();
    }
    function mostrarPlaylistSeguidas(Usuario $usuario){
        $query = "SELECT * FROM playlist p INNER JOIN sigue_playlist sp ON sp.idPlaylist = p.idPlaylist WHERE sp.idUsuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $usuario->idUsuario)
    }
    function dejarDeSeguirPlaylist(Playlist $playlist, Usuario $usuario){
        $query = "DELETE FROM sigue_playlist WHERE idPlaylist = ? AND idUsuario?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ii, $playlist->idPlaylist, $usuario->idUsuario");
        $stmt->execute();
    }
    function mostrarTemasPlaylist(Playlist $playlist){
        $query = "SELECT * FROM tema t INNER JOIN tema_playlist tp ON tp.idTema = t.idTema WHERE tp.idTema = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $playlist->idPlaylist);
        $stmt->execute();
    }
}

?>