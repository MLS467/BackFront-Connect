<?php

namespace sistema;

use sistema\Crud;
use sistema\nucleo\Validacao;

class Telefone_Funcionario extends Crud
{
    private ?int $id;
    private ?string $telefone;
    private ?int $id_funcionario;
    private Validacao $validacao;

    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'telefone_funcionario';
        $this->telefone = $dados['telefone'];
        $this->id_funcionario = $dados['id_funcionario'];
        $this->validacao = new Validacao();
    }

    public function inserirDados(): bool
    {
        try {

            $sql = "INSERT INTO $this->nomeTabela (id,telefone,id_funcionario_fk) VALUES (null, ?, ?)";
            $dados = [
                $this->getTelefone(),
                $this->getIdFuncionario()
            ];

            $stmt = Db::preparar($sql);
            $resultado = $stmt->execute($dados);

            if ($resultado) {
                $this->setId(Db::conectar()->lastInsertId());
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $e) {
            // Log the exception message or handle the error as needed
            error_log($e->getMessage());
            return false;
        }
    }

    function atualizarDados($id) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }


    public function setTelefone(?string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function getIdFuncionario(): int
    {
        return $this->id_funcionario;
    }

    public function setIdFuncionario(int $id_funcionario): void
    {
        $this->id_funcionario = $id_funcionario;
    }
}