<?php

namespace sistema;

use sistema\Crud;
use PDO;
use PDOException;

abstract class Pessoa extends Crud
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
    private ?string $status;
    private ?string $dataNascimento;
    private ?string $cpf;
    private ?string $naturalidade;
    private ?int $idade;

    public function __construct(?array $dados)
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
        $this->status = $dados['status'] ?? null;
        $this->dataNascimento = $dados['dataNascimento'] ?? null;
        $this->cpf = $dados['cpf'] ?? null;
        $this->setIdade($this->dataNascimento) ?? null;
        $this->naturalidade = $dados['naturalidade'] ?? null;
    }

    public function inserirDados() {}
    public function atualizarDados($id) {}



    public function getDataNascimento(): ?string
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(?string $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade($data): void
    {
        $dataAtual = strtotime(date("Y-m-d"));
        $diferencaTempo = $dataAtual - strtotime($data);
        $this->idade = floor($diferencaTempo / (365.25 * 24 * 60 * 60));
    }


    public function getNaturalidade(): ?string
    {
        return $this->naturalidade;
    }

    public function setNaturalidade(?string $naturalidade): void
    {
        $this->naturalidade = $naturalidade;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }


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


    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
}