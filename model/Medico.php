<?php

namespace sistema;

use PDOException;
use sistema\Funcionario;

class Medico extends Funcionario
{
    private int $id = 0;
    private ?string $especialidade;
    private ?string $CRM;
    private ?string $dataNascimento;
    private ?string $observacoes;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->nomeTabela = 'medico';
        $this->especialidade = $dados['especialidade'] ?? null;
        $this->CRM = $dados['CRM'] ?? null;
        $this->dataNascimento = $dados['dataNascimento'] ?? null;
        $this->observacoes = $dados['observacoes'] ?? null;
    }

    public function inserirDados(): bool|string
    {
        try {
            $sql = "INSERT INTO $this->nomeTabela (
                idFuncionario, especialidade, CRM, dataNascimento, observacoes
            ) VALUES (?, ?, ?, ?, ?)";

            $dados = [
                $this->getEspecialidade(),
                $this->getCRM(),
                $this->getDataNascimento(),
                $this->getObservacoes()
            ];

            if (Db::preparar($sql)->execute($dados)) {
                $this->setId(Db::conectar()->lastInsertId());
                return true;
            } else
                return false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
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


    public function getEspecialidade(): ?string
    {
        return $this->especialidade;
    }


    public function setEspecialidade(?string $especialidade): void
    {
        $this->especialidade = $especialidade;
    }


    public function getCRM(): ?string
    {
        return $this->CRM;
    }


    public function setCRM(?string $CRM): void
    {
        $this->CRM = $CRM;
    }


    public function getDataNascimento(): ?string
    {
        return $this->dataNascimento;
    }


    public function setDataNascimento(?string $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }


    public function getObservacoes(): ?string
    {
        return $this->observacoes;
    }


    public function setObservacoes(?string $observacoes): void
    {
        $this->observacoes = $observacoes;
    }
}