<?php

namespace sistema;

use PDO;
use sistema\Crud;

class FichaAtendimento extends Crud
{
    private int $id;
    private int $idPaciente;
    private int $idTriagem;
    private PDO $pdo;

    public function __construct(?array $dados)
    {
        $this->pdo = Db::conectar();
        $this->nomeTabela = 'ficha_atendimento';
        $this->idPaciente = $dados['idPaciente'];
        $this->idTriagem = $dados['idTriagem'];
    }

    function atualizarDados($id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdTriagem(): int
    {
        return $this->idTriagem;
    }

    public function getIdPaciente(): int
    {
        return  $this->idPaciente;
    }

    public function setIdPaciente(int $idPaciente): void
    {
        $this->idPaciente = $idPaciente;
    }


    public function setIdTriagem(int $idTriagem): void
    {
        $this->idTriagem = $idTriagem;
    }

    public function inserirDados(): bool
    {
        $sql = "INSERT INTO ficha_atendimento (idPaciente, idTriagem) VALUES (?, ?)";

        $dados = [
            $this->idPaciente,
            $this->idTriagem
        ];

        if (Db::preparar($sql)->execute($dados)) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }

        return false;
    }
}