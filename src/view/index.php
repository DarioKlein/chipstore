<?php
session_start();

if (!isset($_SESSION['usuario-logado'])) {
  header("Location: /view/login");
  exit;
}

header('Location: /view/modules/dashboard');
