<?php

namespace sistema;

use PDOException;
use sistema\Pessoa;
use sistema\Telefone_Funcionario;

class Medico extends Pessoa
{
    private int $id = 0;
    private ?string $especialidade;
    private ?string $CRM;
    private string $data_inicio_trabalho;
    private ?string $data_termino_trabalho;
    private ?string $observacoes;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->nomeTabela = 'medico';
        $this->especialidade = $dados['especialidade'] ?? null;
        $this->CRM = $dados['CRM'] ?? null;
        $this->observacoes = $dados['observacoes'] ?? null;
        $this->data_inicio_trabalho = date("Y-m-d");
        $this->data_termino_trabalho = null;
    }

    // public function inserirDados(): bool|string
    // {
    //     try {
    //         $sql = "INSERT INTO $this->nomeTabela (
    //             idFuncionario, especialidade, CRM
    //         ) VALUES (?, ?)";

    //         $dados = [
    //             $this->getEspecialidade(),
    //             $this->getCRM(),
    //         ];

    //         if (Db::preparar($sql)->execute($dados)) {
    //             $this->setId(Db::conectar()->lastInsertId());
    // (new Telefone_Funcionario(['telefone'=>$this->telefone, 'id_pessoa'=>$this->id]))->inserirDados();
    //             return true;
    //         } else
    //             return false;
    //     } catch (PDOException $e) {
    //         return $e->getMessage();
    //     }
    // }

    function atualizarDados($id) {}


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

    public function getObservacoes(): ?string
    {
        return $this->observacoes;
    }


    public function setObservacoes(?string $observacoes): void
    {
        $this->observacoes = $observacoes;
    }

    public function getDataInicioTrabalho(): ?string
    {
        return $this->data_inicio_trabalho;
    }

    // Setter para data_inicio_trabalho
    public function setDataInicioTrabalho(?string $data_inicio_trabalho): void
    {
        $this->data_inicio_trabalho = $data_inicio_trabalho;
    }

    // Getter para data_termino_trabalho
    public function getDataTerminoTrabalho(): ?string
    {
        return $this->data_termino_trabalho;
    }

    // Setter para data_termino_trabalho
    public function setDataTerminoTrabalho(?string $data_termino_trabalho): void
    {
        $this->data_termino_trabalho = $data_termino_trabalho;
    }
}