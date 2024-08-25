<?php

namespace sistema;

use sistema\Pessoa;
use PDOException;

class Enfermeiro extends Pessoa
{
    private int $id = 0;
    private string $registroCoren;
    private string $especialidade;
    private string $data_inicio_trabalho;
    private ?string $data_termino_trabalho;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->nomeTabela = 'Enfermeiro';
        $this->data_inicio_trabalho = date("Y-m-d");
        $this->data_termino_trabalho = null;
        $this->registroCoren = $dados['registroCoren'];
        $this->especialidade = $dados['especialidade'];
    }

    // public function inserirDados(): bool
    // {
    //     $sql = "INSERT INTO $this->nomeTabela (
    //     registro_coren, especialidade, horario_de_trabalho
    // ) VALUES (?, ?, ?)";

    //     try {
    //         $query = Db::preparar($sql);

    //         $result = $query->execute([
    //             $this->getRegistroCoren(),
    //             $this->getEspecialidade(),
    //             $this->getHorarioDeTrabalho()
    //         ]);

    //         if ($result) {
    //             $this->setId(Db::conectar()->lastInsertId());
    //             return true;
    //         };
    //     } catch (PDOException $e) {
    //         echo 'Erro ao inserir dados: ' . $e->getMessage();
    //         return false;
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