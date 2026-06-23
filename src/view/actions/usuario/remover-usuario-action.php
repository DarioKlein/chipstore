<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . "/dal/UsuarioDal.php");

use \dal\UsuarioDal;

$id = $_GET['id'] ?? null;

$dal = new UsuarioDal();

$listaUsuarios = $dal->findAll();
if (count($listaUsuarios) <= 1) {
  $_SESSION['msg-usuario-deletado-erro-unico'] = true;
  header('Location: /view/modules/usuario/');
  exit;
}

$resultado = $dal->Delete($id);

if ($resultado) {
  if ((int) $id === $_SESSION['usuario-logado']) {
    session_destroy();
    header('Location: /view/login/');
    exit;
  }

  $_SESSION['msg-usuario-deletado-sucesso'] = true;
  header('Location: /view/modules/usuario/');
} else {
  $_SESSION['msg-usuario-deletado-erro'] = true;
  header('Location: /view/modules/usuario/');
}

exit;
