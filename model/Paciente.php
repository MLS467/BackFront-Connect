<?php

namespace sistema;

use Exception;
use PDO;
use PDOException;
use sistema\Crud;
use sistema\Telefone_Paciente;

class Paciente extends Crud
{
    private ?int $id;
    protected $nomeTabela =  null;
    private ?string $nome = null;
    private ?string $dataNascimento = null;
    private ?string $sexo = null;
    protected ?string $rua = null;
    protected ?string $bairro = null;
    protected ?string $numero = null;
    protected ?string $complemento = null;
    private ?string $telefone = null;
    private ?string $email = null;
    private ?string $naturalidade = null;



    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'paciente';
        $this->nome = $dados['nome'] ?? null;
        $this->dataNascimento = $dados['dataNascimento'] ?? null;
        $this->rua = $dados['rua'] ?? null;
        $this->bairro = $dados['bairro'] ?? null;
        $this->numero = $dados['numero'] ?? null;
        $this->complemento = $dados['complemento'] ?? null;
        $this->telefone = $dados['telefone'] ?? null;
        $this->email = $dados['email'] ?? null;
        $this->sexo = $dados['sexo'] ?? null;
        $this->naturalidade = $dados['naturalidade'] ?? null;
    }


    public function inserirDados(): bool
    {

        $sql = "INSERT INTO $this->nomeTabela VALUES (null,?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $query = Db::preparar($sql)->execute([
            $this->getNome(),
            $this->getDataNascimento(),
            $this->getSexo(),
            $this->getRua(),
            $this->getBairro(),
            $this->getNumero(),
            $this->getComplemento(),
            $this->getEmail(),
            $this->getNaturalidade()
        ]);

        if ($query) {
            $this->id =  Db::conectar()->lastInsertId();
            (new Telefone_Paciente(['telefone' => $this->telefone, 'id_pessoa' => $this->id]))->inserirDados();
            return true;
        }


        return false;
    }




    function atualizarDados($id)
    {
    }


    // Getters

    public function getId(): int
    {
        return $this->id;
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

    public function getNaturalidade(): ?string
    {
        return $this->naturalidade;
    }


    // Setters

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function setNaturalidade(?string $naturalidade): void
    {
        $this->naturalidade = $naturalidade;
    }
}