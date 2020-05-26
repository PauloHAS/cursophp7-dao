<?php 
require_once("config.php");
/*
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM usuario");

echo json_encode($usuarios);

*/

$user = new Usuario();

$user->loadById(5);

echo $user;

 ?>