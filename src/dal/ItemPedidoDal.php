<?php

namespace dal;

include_once(__DIR__ . '/Conexao.php');
include_once(__DIR__ . '/../model/ItemPedido.php');

use \model\ItemPedido;

class ItemPedidoDal
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

      $listaItensPedido = [];

      foreach ($dadosBrutos as $linha) {
        $itemPedido = new ItemPedido();
        $itemPedido->setId($linha['id']);
        $listaItensPedido[] = $itemPedido;
      }

      return $listaItensPedido;
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

      $itemPedido = new ItemPedido();
      $itemPedido->setId($dadoBruto['id']);

      return $itemPedido;
    } catch (\PDOException $e) {
      return null;
    }
  }
}
