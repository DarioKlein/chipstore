<?php

namespace dal;

include_once(__DIR__ . '/Conexao.php');
include_once(__DIR__ . '/../model/Usuario.php');

use \model\Usuario;

class UsuarioDal
{
    public function findAll()
    {
        try {
            $sql = "SELECT * FROM usuario";
            $con = Conexao::conectar();
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $dadosBrutos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            Conexao::desconectar();

            $listaUsuarios = [];

            foreach ($dadosBrutos as $linha) {
                $usuario = new Usuario();
                $usuario->setId($linha['id']);
                $usuario->setNome($linha['nome']);
                $usuario->setEmail($linha['email']);
                $usuario->setSenha($linha['senha']);
                $listaUsuarios[] = $usuario;
            }

            return $listaUsuarios;
        } catch (\PDOException $e) {
            // Pensando no registro de erro de log.
            return [];
        }
    }

    public function findByEmail(string $email)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE email = ?";
            $con = Conexao::conectar();
            $stmt = $con->prepare($sql);
            $stmt->execute([$email]);
            $dadoBruto = $stmt->fetch(\PDO::FETCH_ASSOC);
            Conexao::desconectar();

            if (!$dadoBruto) {
                return null;
            }

            $usuario = new Usuario();
            $usuario->setId($dadoBruto['id']);
            $usuario->setNome($dadoBruto['nome']);
            $usuario->setEmail($dadoBruto['email']);
            $usuario->setSenha($dadoBruto['senha']);

            return $usuario;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function findById(int $id)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id = ?";
            $con = Conexao::conectar();
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            $dadoBruto = $stmt->fetch(\PDO::FETCH_ASSOC);
            Conexao::desconectar();

            if (!$dadoBruto) {
                return null;
            }

            $usuario = new Usuario();
            $usuario->setId($dadoBruto['id']);
            $usuario->setNome($dadoBruto['nome']);
            $usuario->setEmail($dadoBruto['email']);
            $usuario->setSenha($dadoBruto['senha']);

            return $usuario;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function Insert(Usuario $usuario)
    {
        try {
            // Usando prepared statements
            $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";

            $con = Conexao::conectar();
            $stmt = $con->prepare($sql);

            $result = $stmt->execute([
                $usuario->getNome(),
                $usuario->getEmail(),
                $usuario->getSenha(),
            ]);

            Conexao::desconectar();

            return $result;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function Update(Usuario $usuario)
    {
        try {
            $sql = "UPDATE usuario SET nome = ?, email = ?, senha = ? WHERE id = ?";

            $con = Conexao::conectar();
            $stmt = $con->prepare($sql);

            $result = $stmt->execute([
                $usuario->getNome(),
                $usuario->getEmail(),
                $usuario->getSenha(),
            ]);

            Conexao::desconectar();

            return $result;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function Delete(int $id)
    {
        try {
            $sql = "DELETE FROM usuario WHERE id = ?";

            $con = Conexao::conectar();
            $stmt = $con->prepare($sql);
            $stmt->execute([$id]);
            $linhasAfetadas = $stmt->rowCount();
            Conexao::desconectar();

            return $linhasAfetadas > 0;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
