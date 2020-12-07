<?php

session_start();
include('../models/amigo.php');

$id = $_GET['id'];
$friend = new amigo;

if ($friend->eliminar($id))
{
	header('location:/Social Network/amigos.php');
}

?>