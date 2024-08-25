<?php

namespace sistema\nucleo;

use PDOException;
use PDO;
use sistema\Db;

class DadosTemporarios
{
    private $id;
    private $pdo;

    // Construtor da classe que recebe uma instância de PDO
    public function __construct()
    {
        $this->pdo = Db::conectar();
    }

    // Criar um novo dado temporário
    public function criar($idUsuario, $dados)
    {
        $sql = "INSERT INTO dados_temporarios (id_paciente, dados, criado_em, identificador) VALUES (?, ?, NOW(), ?)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute([$idUsuario, $dados, uniqid(date('H:i:s'))])) {
            $this->setId($this->pdo->lastInsertId());
            return $stmt;
        }
        return false;
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
    public function lerTodosPorStatus(string $status)
    {
        $array = array(':status' => $status);
        $sql = "SELECT * FROM dados_temporarios WHERE status = :status ORDER BY criado_em ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($array);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Atualizar um dado temporário
    public function atualizar($id, $dados, $status)
    {
        $sql = "UPDATE dados_temporarios SET dados = ?, status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$dados, $status, $id]);
    }

    public function atualizarStatus($id, $status)
    {
        $sql = "UPDATE dados_temporarios SET status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    public function adcTriagem($id, $id_triagem)
    {
        $sql = "UPDATE dados_temporarios SET id_triagem = ?, dados = 'Paciente/Triagem' WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_triagem, $id]);
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

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}