<?php

namespace dal;

class Conexao
{
  private static $dbname = 'chipstore';
  private static $dbHost = 'db';
  private static $dbUsuario = 'user';
  private static $dbSenha = 'user';

  private static $conexao = null;

  public static function conectar()
  {
    if (self::$conexao == null) {
      self::$conexao = new \PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbname, self::$dbUsuario, self::$dbSenha);
    }
    return self::$conexao;
  }

  public static function desconectar()
  {
    self::$conexao = null;
    return self::$conexao;
  }
}
