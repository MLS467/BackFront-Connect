<?php

namespace sistema;

require_once __DIR__ . '/../config/config.php';


use PDO;
use sistema\nucleo\Validacao;
use sistema\Crud;

class Paciente extends Crud
{

    private ?string $nome = null;
    private ?string $dataNascimento = null;
    private ?string $sexo = null;
    private ?string $endereco = null;
    private ?string $telefone = null;
    private ?string $email = null;
    private ?string $Naturalidade = null;
    private ?int $triagemId = null;
    private ?Validacao $validacao = null;

    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'pacientes';
        $this->triagemId = $dados['id_triagemCompleta'] ?? null;
        $this->nome = $dados['nome'] ?? null;
        $this->dataNascimento = $dados['dataNascimento'] ?? null;
        $this->endereco = $dados['endereco'] ?? null;
        $this->telefone = $dados['telefone'] ?? null;
        $this->email = $dados['email'] ?? null;
        $this->sexo = $dados['sexo'] ?? null;
        $this->Naturalidade = $dados['Naturalidade'] ?? null;
        $this->validacao = new Validacao();
    }

    function inserirDados()
    {
        if ($this->getValidacao()->validaForm($this->getNome(), $this->getEmail(), $this->getSexo())) {

            $sql = "INSERT INTO $this->nomeTabela (nome, data_nascimento, sexo, endereco, telefone, email, naturalidade, triagem_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $query = Db::preparar($sql);
            $result = $query->execute(array(
                $this->getNome(),
                $this->getDataNascimento(),
                $this->getSexo(),
                $this->getEndereco(),
                $this->getTelefone(),
                $this->getEmail(),
                $this->getNaturalidade(),
                $this->getTriagemId()
            ));

            if (!$result)
                return false;
            return true;
        } else {
            return false;
        }
    }


    function atualizarDados($id)
    {
    }

    public function mostraDados(): array
    {
        $sql = "SELECT * FROM pacientes AS P 
        INNER JOIN sinais_vitais AS SV 
        ON (P.triagem_id = SV.id) 
        INNER JOIN triagem AS T 
        ON (SV.triagem_id = T.id)
        ORDER BY P.nome LIMIT 100";

        $res = Db::preparar($sql);
        $res->execute();
        return $res->fetchAll();
    }


    // Getters
    public function getValidacao(): Validacao
    {
        return $this->validacao;
    }

    public function getNaturalidade(): string
    {
        return $this->Naturalidade;
    }

    public function setNaturalidade(string $Naturalidade)
    {
        return $this->Naturalidade = $Naturalidade;
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
    public function setTriagem(int $triagem): int
    {
        return $this->triagemId = $triagem;
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