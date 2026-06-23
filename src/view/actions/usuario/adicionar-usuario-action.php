<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/dal/UsuarioDal.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/model/Usuario.php');

use \dal\UsuarioDal;
use \model\Usuario;

$nome = $_POST['nome'] ?? null;
$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;

$usuario = new Usuario();
$usuario->setNome($nome);
$usuario->setEmail($email);

$dal = new UsuarioDal();

if ($dal->findByEmail($email) !== null) {
  $_SESSION['msg-erro-criando-usuario-email-invalido'] = true;
  $_SESSION['conteudo-usuario-erro'] = $usuario;
  header('Location: /view/modules/usuario/adicionar/');
  exit;
}

$usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));

$result = $dal->Insert($usuario);

if ($result) {
  $_SESSION['msg-usuario-criado'] = true;
  header('Location: /view/modules/usuario/');
  exit;
}

$_SESSION['msg-erro-criando-usuario'] = true;
$_SESSION['conteudo-usuario-erro'] = $usuario;
header('Location: /view/modules/usuario/adicionar/');
exit;
