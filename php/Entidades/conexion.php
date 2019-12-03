<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


class Conexion{
    private $servidor = "localhost";
    private $BBDD = "mvsix";
    private $usuario = "root";
    private $contra = "";
    public $conn;
 
    public function getConexion(){
        $this->conn = new mysqli($this->servidor, $this->usuario, $this->contra,$this->BBDD);
      
        mysqli_set_charset($this->conn, "utf8");
        
        if ($this->conn->connect_error) {
            die("Falló la conexión con la base de datos: " . $this->conn->connect_error);
        }
        return $this->conn;
          
    }
    
    public function cerrarConexion(){
        $this->conn->close();
    }
    
}


?>