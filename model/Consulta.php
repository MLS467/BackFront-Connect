<?php

namespace sistema;



use sistema\Crud;
use PDOException;

class Consulta extends Crud
{
    private int $id;
    private int $id_ficha_atendimento_fk;
    private int $id_medico_fk;
    private ?string $dataHora;
    private ?string $diagnostico;
    private ?string $tratamento;
    private ?string $observacoes;
    private ?string $status;


    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'consulta';
        $this->id_ficha_atendimento_fk = $dados['id_ficha_atendimento_fk'];
        $this->id_medico_fk = $dados['id_medico_fk'];
        $this->dataHora = $dados['dataHora'] ?? null;
        $this->diagnostico = $dados['diagnostico'] ?? null;
        $this->tratamento = $dados['tratamento'] ?? null;
        $this->observacoes = $dados['observacoes'] ?? null;
        $this->status = $dados['status'] ?? null;
    }

    public function inserirDados(): bool
    {
        $sql = "INSERT INTO $this->nomeTabela (
            id_ficha_atendimento_fk, id_medico_fk, dataHora, diagnostico, tratamento, observacoes, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $query = Db::preparar($sql);

            $result = $query->execute([
                $this->getIdFichaAtendimentoFk(),
                $this->getIdMedicoFk(),
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


    function atualizarDados($id)
    {
    }

    // Getter e Setter para id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Getter e Setter para id_ficha_atendimento_fk
    public function getIdFichaAtendimentoFk(): int
    {
        return $this->id_ficha_atendimento_fk;
    }

    public function setIdFichaAtendimentoFk(int $id_ficha_atendimento_fk): void
    {
        $this->id_ficha_atendimento_fk = $id_ficha_atendimento_fk;
    }

    // Getter e Setter para id_medico_fk
    public function getIdMedicoFk(): int
    {
        return $this->id_medico_fk;
    }

    public function setIdMedicoFk(int $id_medico_fk): void
    {
        $this->id_medico_fk = $id_medico_fk;
    }

    // Getter e Setter para dataHora
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