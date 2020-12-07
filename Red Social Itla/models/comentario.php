<?php

class comentario
{
    var $id;
    var $id_publicacion;
    var $id_usuario;
    var $contenido;
    var $fecha;

    public function getComentariosPublicacion($idPublicacion)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $stmt = $conn->query("SELECT c.id, c.id_publicacion, c.contenido, c.fecha, CONCAT(u.nombre,' ',u.apellido,' (',u.usuario,')') as usuario FROM comentarios c INNER JOIN usuarios u ON u.id = c.id_usuario");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function comentar($comment)
    {
        $conn = new PDO('mysql:host=localhost;dbname=socialnetwork', 'root', ''); 
        $sql = "INSERT INTO comentarios (id_publicacion, id_usuario, contenido, fecha) VALUES($comment->id_publicacion, $comment->id_usuario, '$comment->contenido', '$comment->fecha')";

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