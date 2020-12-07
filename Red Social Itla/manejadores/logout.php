<?php
session_start();
$_SESSION = [];
session_destroy();
header('location:/Social Network/index.php');
?>