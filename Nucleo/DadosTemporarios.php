<?php

namespace sistema\nucleo;

use PDOException;
use PDO;
use sistema\Db;

class DadosTemporarios
{
    private $pdo;

    // Construtor da classe que recebe uma instância de PDO
    public function __construct()
    {
        $this->pdo = Db::conectar();
    }

    // Criar um novo dado temporário
    public function criar($idUsuario, $dados)
    {
        $sql = "INSERT INTO dados_temporarios (id_usuario, dados) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$idUsuario, $dados]);
    }

    // Ler dados temporários pelo ID
    public function ler($id)
    {
        $sql = "SELECT * FROM dados_temporarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ler todos os dados temporários com status específico
    public function lerTodosPorStatus($status)
    {
        $sql = "SELECT * FROM dados_temporarios WHERE status = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Atualizar um dado temporário
    public function atualizar($id, $dados, $status)
    {
        $sql = "UPDATE dados_temporarios SET dados = ?, status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$dados, $status, $id]);
    }

    // Deletar um dado temporário
    public function deletar($id)
    {
        $sql = "DELETE FROM dados_temporarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function deletarTodos()
    {
        $sql = "TRUNCATE TABLE dados_temporarios";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }
}