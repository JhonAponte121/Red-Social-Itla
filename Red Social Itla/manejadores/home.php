<?php

session_start();
include('../models/publicacion.php');
date_default_timezone_set('America/Santo_Domingo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $post = new publicacion;
    $post->id_usuario = $_SESSION['logueado'];
    $post->contenido = trim($_POST['contenido']);
    $post->fecha = (new DateTime())->format('Y-m-d H:i:s');

    if ($post->publicar($post))
    {
        header('location:/Social Network/home.php');
    }
}