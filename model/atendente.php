<?php

namespace sistema;

use PDOException;
use sistema\Funcionario;

class Atendente extends Funcionario
{

    private int $id;
    private ?string $dataInicioTrabalho;
    private ?string $areaAtuacao;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->nomeTabela = 'atendente';
        $this->dataInicioTrabalho = $dados['dataInicioTrabalho'];
        $this->areaAtuacao = $dados['areaAtuacao'];
    }


    function inserirDados(): bool | string
    {
        try {
            $dados = [
                $this->getNomeCompleto(),
                $this->getCidade(),
                $this->getRua(),
                $this->getBairro(),
                $this->getNumero(),
                $this->getComplemento(),
                $this->getTelefone(),
                $this->getEmail(),
                $this->getGenero(),
                $this->getDataRegistro(),
                $this->getStatus(),
                $this->getDataInicioTrabalho(),
                $this->getAreaAtuacao()
            ];

            $sql = "INSERT INTO $this->nomeTabela VALUES (null,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if (Db::preparar($sql)->execute($dados)) {
                $this->setId(Db::conectar()->lastInsertId());
                return true;
            };
            return false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function atualizarDados($id)
    {
    }

    // Getter para id
    public function getId(): int
    {
        return $this->id;
    }

    // Setter para id
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Getter para dataInicioTrabalho
    public function getDataInicioTrabalho(): ?string
    {
        return $this->dataInicioTrabalho;
    }

    // Setter para dataInicioTrabalho
    public function setDataInicioTrabalho(?string $dataInicioTrabalho): void
    {
        $this->dataInicioTrabalho = $dataInicioTrabalho;
    }

    // Getter para areaAtuacao
    public function getAreaAtuacao(): ?string
    {
        return $this->areaAtuacao;
    }

    // Setter para areaAtuacao
    public function setAreaAtuacao(?string $areaAtuacao): void
    {
        $this->areaAtuacao = $areaAtuacao;
    }
}