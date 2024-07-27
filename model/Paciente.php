<?php

namespace sistema;

require_once('../config/config.php');
require_once('../model/Crud.php');

use PDO;

class Paciente extends Crud
{
    private ?array $triagem = null;
    private ?string $nome = null;
    private ?string $dataNascimento = null;
    private ?string $sexo = null;
    private ?string $endereco = null;
    private ?string $telefone = null;
    private ?string $email = null;
    private ?int $triagemId = null;
    private ?Validacao $validacao = null;

    public function __construct(?array $triagem, ?array $dados)
    {
        $this->nomeTabela = 'pacientes';
        $this->triagem = $triagem;
        $this->triagemId = $triagem['id'];
        $this->nome = $dados['nome'];
        $this->dataNascimento = $dados['dataNascimeto'];
        $this->endereco = $dados['endereco'];
        $this->telefone = $dados['telefone'];
        $this->email = $dados['email'];
        $this->sexo = $dados['sexo'];
        $this->validacao = new Validacao();
    }

    function inserirDados()
    {
        if ($this->getValidacao()->validaForm($this->getNome(), $this->getEmail(), $this->getSexo())) {

            $sql = "INSERT INTO $this->nomeTabela VALUES (?,?,?,?,?,?,?,?)";

            $query = Db::preparar($sql);
            $query->execute(array(
                null,
                $this->getNome(),
                $this->getDataNascimento(),
                $this->getSexo(),
                $this->getEndereco(),
                $this->getTelefone(),
                $this->getEmail(),
                $this->getTriagemId()
            ));

            if (!$query)
                return false;
            return true;
        } else {
            return false;
        }
    }
    function atualizarDados($id)
    {
    }


    // Getters
    public function getValidacao(): Validacao
    {
        return $this->validacao;
    }


    public function getTriagem(): array
    {
        return $this->triagem;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function getDataNascimento(): ?string
    {
        return $this->dataNascimento;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getTriagemId(): ?int
    {
        return $this->triagemId;
    }

    // Setters
    public function setTriagem(Triagem $triagem): void
    {
        $this->triagem = $triagem;
    }

    public function setValidacao(Validacao $validacao)
    {
        $this->validacao = $validacao;
    }

    public function setNome(?string $nome): void
    {
        $this->nome = $nome;
    }

    public function setDataNascimento(?string $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function setSexo(?string $sexo): void
    {
        $this->sexo = $sexo;
    }

    public function setEndereco(?string $endereco): void
    {
        $this->endereco = $endereco;
    }

    public function setTelefone(?string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setTriagemId(?int $triagemId): void
    {
        $this->triagemId = $triagemId;
    }
}