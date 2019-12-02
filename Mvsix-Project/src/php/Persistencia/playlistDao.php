<?php

require("../Entidades/conexion.php");
require("../Entidades/playlist.php");
require("../Entidades/usuario.php");

class PlaylistDao{
    
    function actualizarPlaylist(Playlist $playlist){
        $query = "UPDATE playlist set nombrePlaylist = ?, numTemas = ? where idPlaylist = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sii", $playlist->nombrePlaylist, $playlist->numTemas, $playlist->idPlaylist);
        $stmt->execute();
    }
    function eliminarPlaylist(){
        $query = "DELETE FROM playlist where idPlaylist = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $playlist->idPlaylist);
        $stmt->execute();
    }
    
}

?>