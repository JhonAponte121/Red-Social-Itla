<?php

class amigo
{
    var $id;
    var $id_usuario;
    var $id_amigo;

    public function getAmigosUsuario($idUsuario)
    {
    	$conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $stmt = $conn->query("SELECT a.id, u.nombre, u.apellido, u.usuario
            FROM amigos a
            INNER JOIN usuarios u ON u.id = a.id_amigo
            WHERE a.id_usuario = $idUsuario");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function agregar($friend)
    {
    	$conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $sql = "INSERT INTO amigos (id_usuario, id_amigo) VALUES('$friend->id_usuario', '$friend->id_amigo')";

        if($conn->query($sql))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function eliminar($aid)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', '');
        $sql = "DELETE FROM amigos WHERE id = '$aid'";

        if($conn->query($sql))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }
}