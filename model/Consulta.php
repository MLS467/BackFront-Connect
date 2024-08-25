<?php

namespace sistema;



use sistema\Crud;
use PDOException;

class Consulta extends Crud
{
    private int $id;
    private int $id_medico;
    private int $id_paciente;
    private int $id_triagem;
    private ?string $dataHora;
    private ?string $diagnostico;
    private ?string $tratamento;
    private ?string $observacoes;
    private ?string $status;


    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'consulta';
        $this->id_medico = $dados['id_medico'];
        $this->id_paciente = $dados['id_paciente'];
        $this->id_triagem = $dados['id_triagem'];
        $this->dataHora = $dados['dataHora'] ?? null;
        $this->diagnostico = $dados['diagnostico'] ?? null;
        $this->tratamento = $dados['tratamento'] ?? null;
        $this->observacoes = $dados['observacoes'] ?? null;
        $this->status = $dados['status'] ?? null;
    }

    public function inserirDados(): bool
    {
        try {

            $sql = "INSERT INTO $this->nomeTabela VALUES (null,?, ?, ?, ?, ?, ?, ?, ?)";

            $query = Db::preparar($sql);

            $result = $query->execute([
                $this->getIdMedico(),
                $this->getIdTriagem(),
                $this->getIdPaciente(),
                $this->getDataHora(),
                $this->getDiagnostico(),
                $this->getTratamento(),
                $this->getObservacoes(),
                $this->getStatus()
            ]);

            if ($result) {
                $this->setId(Db::conectar()->lastInsertId());
                return true;
            }
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function getIdMedico(): int
    {
        return $this->id_medico;
    }

    // Setter para id_medico
    public function setIdMedico(int $id_medico): void
    {
        $this->id_medico = $id_medico;
    }

    // Getter para id_paciente
    public function getIdPaciente(): int
    {
        return $this->id_paciente;
    }

    // Setter para id_paciente
    public function setIdPaciente(int $id_paciente): void
    {
        $this->id_paciente = $id_paciente;
    }

    // Getter para id_triagem
    public function getIdTriagem(): int
    {
        return $this->id_triagem;
    }

    // Setter para id_triagem
    public function setIdTriagem(int $id_triagem): void
    {
        $this->id_triagem = $id_triagem;
    }


    function atualizarDados($id) {}

    // Getter e Setter para id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDataHora(): ?string
    {
        return $this->dataHora;
    }

    public function setDataHora(?string $dataHora): void
    {
        $this->dataHora = $dataHora;
    }

    // Getter e Setter para diagnostico
    public function getDiagnostico(): ?string
    {
        return $this->diagnostico;
    }

    public function setDiagnostico(?string $diagnostico): void
    {
        $this->diagnostico = $diagnostico;
    }

    // Getter e Setter para tratamento
    public function getTratamento(): ?string
    {
        return $this->tratamento;
    }

    public function setTratamento(?string $tratamento): void
    {
        $this->tratamento = $tratamento;
    }

    // Getter e Setter para observacoes
    public function getObservacoes(): ?string
    {
        return $this->observacoes;
    }

    public function setObservacoes(?string $observacoes): void
    {
        $this->observacoes = $observacoes;
    }

    // Getter e Setter para status
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
}