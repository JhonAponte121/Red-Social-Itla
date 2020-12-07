<?php

session_start();
include('../models/publicacion.php');

$idPublicacion = $_GET['id_publicacion'];
$post = new publicacion;

if ($post->eliminar($idPublicacion))
{
    header('location:/Social Network/home.php');
}

?>