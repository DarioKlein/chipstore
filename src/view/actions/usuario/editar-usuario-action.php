<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/dal/UsuarioDal.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/model/Usuario.php');

use \dal\UsuarioDal;
use \model\Usuario;

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? null;
$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;

$usuario = new Usuario();
$usuario->setId($id);
$usuario->setNome($nome);
$usuario->setEmail($email);

$dal = new UsuarioDal();

$usuarioExistente = $dal->findByEmail($email);
if ($usuarioExistente !== null && $usuarioExistente->getId() != $id) {
  $_SESSION['msg-erro-editando-usuario-email-invalido'] = true;
  $_SESSION['conteudo-editando-usuario-erro'] = $usuario;
  header('Location: /view/modules/usuario/editar/?id=' . $usuario->getId());
  exit;
}

if (!empty($senha)) {
  $usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));
} else {
  $usuarioAtual = $dal->findById((int) $id);
  $usuario->setSenha($usuarioAtual->getSenha());
}

$result = $dal->Update($usuario);

if ($result) {
  $_SESSION['msg-usuario-editado-sucesso'] = true;
  header('Location: /view/modules/usuario/');
} else {
  $_SESSION['msg-erro-editando-usuario'] = true;
  $_SESSION['conteudo-editando-usuario-erro'] = $usuario;
  header('Location: /view/modules/usuario/editar/?id=' . $usuario->getId());
}

exit;
