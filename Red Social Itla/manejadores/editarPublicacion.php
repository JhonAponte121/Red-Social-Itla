<?php

session_start();
include('../models/publicacion.php');

date_default_timezone_set('America/Santo_Domingo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $post = new publicacion;
    $post->id = trim($_POST['id_publicacion']);
    $post->contenido = trim($_POST['contenidoPublicacion']);
    
    if ($post->editar($post))
    {
        header('location:/Social Network/home.php');
    }
}