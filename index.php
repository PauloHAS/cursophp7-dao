<?php 
require_once("config.php");
/*
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM usuario");

echo json_encode($usuarios);

*/
//lista um unico usuario
/*
$user = new Usuario();

$user->loadById(5);

echo $user;
*/
//lista de varios usuario
/*
$lista = Usuario::search("ia");

echo json_encode($lista)
*/

//carrega um usuario usando o login e senha
/*
$usuario = new Usuario();

$usuario ->login("paulo","12345");

echo $usuario;
*/

//criando um novo usuario
/*
$aluno = new Usuario("Andres", "112233");
$aluno -> insert();

echo $aluno;
*/

//alterando um novo usuario
/*
$usuario = new Usuario();

$usuario -> loadById(8);

$usuario->update("Henrique", "001122");

echo $usuario
 */

$usuario = new Usuario();

$usuario ->loadById(9);

$usuario ->delete();


echo $usuario;
 ?>
