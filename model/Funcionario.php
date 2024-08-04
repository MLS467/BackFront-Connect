<?php

namespace sistema;

use sistema\Crud;
use PDO;
use PDOException;

abstract class Funcionario extends Crud
{
    private ?string $nomeCompleto;
    private ?string $cidade;
    private ?string $rua;
    private ?string $bairro;
    private ?string $numero;
    private ?string $complemento;
    private ?string $telefone;
    private ?string $email;
    private ?string $genero;
    private ?string $dataRegistro;
    private ?string $status;


    public function __construct(array $dados)
    {
        $this->nomeCompleto = $dados['nomeCompleto'] ?? null;
        $this->cidade = $dados['cidade'] ?? null;
        $this->rua = $dados['rua'] ?? null;
        $this->bairro = $dados['bairro'] ?? null;
        $this->numero = $dados['numero'] ?? null;
        $this->complemento = $dados['complemento'] ?? null;
        $this->telefone = $dados['telefone'] ?? null;
        $this->email = $dados['email'] ?? null;
        $this->genero = $dados['genero'] ?? null;
        $this->dataRegistro = $dados['dataRegistro'] ?? null;
        $this->status = $dados['status'] ?? null;
    }

    public function inserirDados()
    {
    }
    public function atualizarDados($id)
    {
    }

    public function getNomeCompleto(): ?string
    {
        return $this->nomeCompleto;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function getRua(): ?string
    {
        return $this->rua;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function getDataRegistro(): ?string
    {
        return $this->dataRegistro;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    // Setters
    public function setNomeCompleto(?string $nomeCompleto): void
    {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function setCidade(?string $cidade): void
    {
        $this->cidade = $cidade;
    }

    public function setRua(?string $rua): void
    {
        $this->rua = $rua;
    }

    public function setBairro(?string $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function setNumero(?string $numero): void
    {
        $this->numero = $numero;
    }

    public function setComplemento(?string $complemento): void
    {
        $this->complemento = $complemento;
    }

    public function setTelefone(?string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setGenero(?string $genero): void
    {
        $this->genero = $genero;
    }

    public function setDataRegistro(?string $dataRegistro): void
    {
        $this->dataRegistro = $dataRegistro;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
}