<?php

namespace sistema;

use sistema\Crud;
use sistema\nucleo\Validacao;

class Telefone_Paciente extends Crud
{
    private int $id = 0;
    private ?string $telefone;
    private int $id_pessoa;
    private Validacao $validacao;

    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'telefone_paciente';
        $this->telefone = $dados['telefone'];
        $this->id_pessoa = $dados['id_pessoa'];
        $this->validacao = new Validacao();
    }

    public function inserirDados()
    {
        try {
            if (
                $this->validacao->validarTelefone($this->getTelefone())
            ) {

                $sql = "INSERT INTO $this->nomeTabela VALUES (?,?,?)";
                $dados = [
                    null,
                    $this->getTelefone(),
                    $this->getIdPessoa()
                ];

                if (Db::preparar($sql)->execute($dados)) {
                    $this->setId(Db::conectar()->lastInsertId());
                    return true;
                }
                return false;
            } else {
                return false;
            }
        } catch (\Throwable $e) {
            ///////////////////////////////////////
        }
    }

    function atualizarDados($id)
    {
    }

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

    public function getIdPessoa(): int
    {
        return $this->id_pessoa;
    }

    public function setIdPessoa(int $id_pessoa): void
    {
        $this->id_pessoa = $id_pessoa;
    }
}