<?php

namespace sistema;

use sistema\Funcionario;
use PDOException;

class Enfermeiro extends Funcionario
{
    private int $id = 0;
    private string $registroCoren;
    private string $especialidade;
    private ?int $horarioDeTrabalho;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->nomeTabela = 'Enfermeiro';
        $this->registroCoren = $dados['registroCoren'];
        $this->especialidade = $dados['especialidade'];
        $this->horarioDeTrabalho = $dados['horarioDeTrabalho'];
    }

    public function inserirDados(): bool
    {
        $sql = "INSERT INTO $this->nomeTabela (
        registro_coren, especialidade, horario_de_trabalho
    ) VALUES (?, ?, ?)";

        try {
            $query = Db::preparar($sql);

            $result = $query->execute([
                $this->getRegistroCoren(),
                $this->getEspecialidade(),
                $this->getHorarioDeTrabalho()
            ]);

            if ($result) {
                $this->setId(Db::conectar()->lastInsertId());
                return true;
            };
        } catch (PDOException $e) {
            echo 'Erro ao inserir dados: ' . $e->getMessage();
            return false;
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

    public function getRegistroCoren(): string
    {
        return $this->registroCoren;
    }

    public function setRegistroCoren(string $registroCoren): void
    {
        $this->registroCoren = $registroCoren;
    }

    public function getEspecialidade(): string
    {
        return $this->especialidade;
    }

    public function setEspecialidade(string $especialidade): void
    {
        $this->especialidade = $especialidade;
    }

    public function getHorarioDeTrabalho(): ?int
    {
        return $this->horarioDeTrabalho;
    }

    public function setHorarioDeTrabalho(?int $horarioDeTrabalho): void
    {
        $this->horarioDeTrabalho = $horarioDeTrabalho;
    }
}