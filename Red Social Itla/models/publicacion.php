<?php

class publicacion
{
    var $id;
    var $id_usuario;
    var $contenido;
    var $fecha;

    public function getPublicacionesUsuario($idUsuario)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $stmt = $conn->query("SELECT * FROM publicaciones p WHERE id_usuario = '$idUsuario' ORDER BY fecha DESC");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPublicacionesAmigos($idUsuario)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $stmt = $conn->query("SELECT p.id, p.contenido, p.fecha, u.nombre, u.apellido, u.usuario  
            FROM publicaciones p 
            INNER JOIN amigos a ON a.id_amigo = p.id_usuario
            INNER JOIN usuarios u ON u.id = a.id_amigo
            WHERE a.id_usuario = $idUsuario ORDER BY p.fecha DESC");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function publicar($post)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $sql = "INSERT INTO publicaciones (id_usuario, contenido, fecha) VALUES($post->id_usuario, '$post->contenido', '$post->fecha')";

        if($conn->query($sql))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function editar($post)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $sql = "UPDATE publicaciones SET contenido = '$post->contenido' WHERE id=$post->id";

        if($conn->query($sql))
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    public function eliminar($idPublicacion)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', '');
        $conn->query("DELETE FROM comentarios WHERE id_publicacion = '$idPublicacion'");
        $sql = "DELETE FROM publicaciones WHERE id = '$idPublicacion'";

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