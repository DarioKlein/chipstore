<?php

namespace model;

class Usuario
{
  private ?int $id;

  private ?string $nome;

  private ?string $email;

  private ?string $senha;

  public function __construct() {}

  public function getId()
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome(string $nome)
  {
    $this->nome = $nome;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail(string $email)
  {
    $this->email = $email;
  }

  public function getSenha()
  {
    return $this->senha;
  }

  public function setSenha(string $senha)
  {
    $this->senha = $senha;
  }
}
