<?php

namespace dal;

include_once(__DIR__ . '/Conexao.php');
include_once(__DIR__ . '/../model/Cliente.php');

use \model\Cliente;

class ClienteDal
{
  public function findAll()
  {
    try {
      $sql = "SELECT * FROM pedido";
      $con = Conexao::conectar();
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $dadosBrutos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

      $listaClientes = [];

      foreach ($dadosBrutos as $linha) {
        $cliente = new Cliente();
        $cliente->setId($linha['id']);
        $listaClientes[] = $cliente;
      }

      return $listaClientes;
    } catch (\PDOException $e) {
      return [];
    }
  }

  public function findById(int $id)
  {
    try {
      $sql = "SELECT * FROM pedido WHERE id = ?";
      $con = Conexao::conectar();
      $stmt = $con->prepare($sql);
      $stmt->execute(array($id));
      $dadoBruto = $stmt->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

      if (!$dadoBruto) {
        return null;
      }

      $cliente = new Cliente();
      $cliente->setId($dadoBruto['id']);

      return $cliente;
    } catch (\PDOException $e) {
      return null;
    }
  }
}
