<?php

namespace sistema;

use PDO;
use sistema\Crud;

class FichaAtendimento extends Crud
{
    private ?int $id;
    private ?int $idPaciente;
    private ?int $idTriagem;
    private PDO $pdo;

    public function __construct(?array $dados)
    {
        $this->pdo = Db::conectar() ?? null;
        $this->nomeTabela = 'ficha_atendimento' ?? null;
        $this->idPaciente = $dados['idPaciente'] ?? null;
        $this->idTriagem = $dados['idTriagem'] ?? null;
    }

    function atualizarDados($id)
    {
        $sql = "UPDATE $this->nomeTabela SET status = 2 WHERE id=?";
        Db::preparar($sql)->execute([$id]);
    }


    public function lerTodosDados($id)
    {
        $sql = "SELECT 
        fa.id as id_ficha_Atendimento,
        fa.*,
        p.*,
        t.*,
        sv.*,
        db.*
         FROM ficha_atendimento AS fa
        JOIN paciente AS p ON fa.idPaciente = p.id
        JOIN triagem AS t ON fa.idTriagem = t.id 
        JOIN sinais_vitais as sv ON t.id_sinais_vitais_fk = sv.id 
        JOIN dados_basicos as db ON t.id_dados_basicos_fk = db.id
        WHERE p.id = $id  LIMIT 100";

        $res = Db::preparar($sql);
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC);
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