<?php

session_start();
include('../models/comentario.php');

date_default_timezone_set('America/Santo_Domingo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = new comentario;
    $comment->id_publicacion = trim($_POST['id_publicacion']);
    $comment->id_usuario = $_SESSION['logueado'];
    $comment->contenido = trim($_POST['contenido']);
    $comment->fecha = (new DateTime())->format('Y-m-d H:i:s');

    if ($comment->comentar($comment))
    {
    	if($_POST['page']=="home")
    	{
    		header('location:/Social Network/home.php');
    	}
    	else
    	{
    		header('location:/Social Network/amigos.php');
    	}
        
    }
}