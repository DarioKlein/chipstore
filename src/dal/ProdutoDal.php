<?php

namespace dal;

include_once(__DIR__ . '/Conexao.php');
include_once(__DIR__ . '/../model/Produto.php');

use \model\Produto;

class ProdutoDal
{
  public function findAll()
  {
    try {
      $sql = "SELECT * FROM produto";
      $con = Conexao::conectar();
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $dadosBrutos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

      $listaProdutos = [];

      foreach ($dadosBrutos as $linha) {
        $produto = new Produto();
        $produto->setId($linha['id']);
        $listaProdutos[] = $produto;
      }

      return $listaProdutos;
    } catch (\PDOException $e) {
      return [];
    }
  }

  public function findById(int $id)
  {
    try {
      $sql = "SELECT * FROM produto WHERE id = ?";
      $con = Conexao::conectar();
      $stmt = $con->prepare($sql);
      $stmt->execute(array($id));
      $dadoBruto = $stmt->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

      if (!$dadoBruto) {
        return null;
      }

      $produto = new Produto();
      $produto->setId($dadoBruto['id']);

      return $produto;
    } catch (\PDOException $e) {
      return null;
    }
  }
}
