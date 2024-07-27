<?php

namespace sistema;

require_once('../config/config.php');
require_once('../autoload.php');

use PDO;

class Funcionario extends Crud
{

    private ?string $nome = null;
    private ?string $dataNascimento = null;
    private ?string $sexo = null;
    private ?string $telefone = null;
    private ?string $email = null;
    private ?string $cargo = null;
    private ?string $departamento = null;
    private ?string $dataAdmissao = null;
    private ?float $salario = null;
    private ?string $numeroRegistroProfissional = null;
    private ?string $statusEmprego = null;


    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'funcionarios';
        $this->nome = $dados['nome'];
        $this->dataNascimento = $dados['dataNascimento'];
        $this->sexo = $dados['sexo'];
        $this->telefone = $dados['telefone'];
        $this->email = $dados['email'];
        $this->cargo = $dados['cargo'];
        $this->departamento = $dados['departamento'];
        $this->dataAdmissao = $dados['dataAdmissao'];
        $this->salario = $dados['salario'];
        $this->numeroRegistroProfissional = $dados['numeroRegistroProfissional'];
        $this->statusEmprego = $dados['statusEmprego'];
    }

    public function inserirDados()
    {
        $sql = "INSERT INTO $this->nomeTabela VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = Db::preparar($sql);
        $query->execute(array(
            null,
            $this->getNome(),
            $this->getDataNascimento(),
            $this->getSexo(),
            $this->getTelefone(),
            $this->getEmail(),
            $this->getCargo(),
            $this->getDepartamento(),
            $this->getDataAdmissao(),
            $this->getSalario(),
            $this->getNumeroRegistroProfissional(),
            $this->getStatusEmprego()
        ));

        if (!$query)
            return false;
        return true;
    }



    function atualizarDados($id)
    {
    }

    // Getters e Setters
    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): void
    {
        $this->nome = $nome;
    }

    public function getDataNascimento(): ?string
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(?string $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): void
    {
        $this->sexo = $sexo;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): void
    {
        $this->cargo = $cargo;
    }

    public function getDepartamento(): ?string
    {
        return $this->departamento;
    }

    public function setDepartamento(?string $departamento): void
    {
        $this->departamento = $departamento;
    }

    public function getDataAdmissao(): ?string
    {
        return $this->dataAdmissao;
    }

    public function setDataAdmissao(?string $dataAdmissao): void
    {
        $this->dataAdmissao = $dataAdmissao;
    }

    public function getSalario(): ?float
    {
        return $this->salario;
    }

    public function setSalario(?float $salario): void
    {
        $this->salario = $salario;
    }

    public function getNumeroRegistroProfissional(): ?string
    {
        return $this->numeroRegistroProfissional;
    }

    public function setNumeroRegistroProfissional(?string $numeroRegistroProfissional): void
    {
        $this->numeroRegistroProfissional = $numeroRegistroProfissional;
    }

    public function getStatusEmprego(): ?string
    {
        return $this->statusEmprego;
    }

    public function setStatusEmprego(?string $statusEmprego): void
    {
        $this->statusEmprego = $statusEmprego;
    }
}