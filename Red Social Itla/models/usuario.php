<?php

class usuario
{
    var $id;
    var $nombre;
    var $apellido;
    var $telefono;
    var $correo;
    var $nombre_usuario;
    var $contraseña;

    public function getUsuario($nombre_usuario)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $stmt = $conn->query("SELECT * FROM usuarios WHERE usuario = '$nombre_usuario'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row;
    }

    public function registrar($user)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $sql = "INSERT INTO usuarios (nombre, apellido, telefono, correo, usuario, contraseña) VALUES('$user->nombre', '$user->apellido', '$user->telefono', '$user->correo', '$user->nombre_usuario', '$user->contraseña')";

        if($conn->query($sql))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function verificarDisponibilidad($user)
    {   
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $stmt = $conn->query("SELECT usuario FROM usuarios WHERE usuario = '$user'");
        $stmt->execute();

        if ($stmt->rowcount()) 
        {
            return false;
        } 
        else 
        {
            return true;
        }
    }
}
