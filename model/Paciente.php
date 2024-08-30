<?php

namespace sistema;

use sistema\nucleo\Validacao;
use sistema\Telefone_Paciente;
use PDO;


class Paciente extends Pessoa
{
    private ?int $id;
    private ?int $id_atendente;
    private ?string $alergia;
    private ?string $historicoCirurgia;
    private ?string $contatoEmergencia;
    private Validacao $validacao;


    public function __construct(?array $dados = null)
    {
        parent::__construct($dados);
        $this->validacao = new Validacao();
        $this->id_atendente = $dados['id_atendente'] ?? null;
        $this->nomeTabela = 'paciente' ?? null;
        $this->alergia = $dados['alergia'] ?? null;
        $this->historicoCirurgia = $dados['historicoCirurgia'] ?? null;
        $this->contatoEmergencia = $dados['contatoEmergencia'] ?? null;
    }

    public function inserirDados(): bool
    {
        try {
            if (
                $this->validacao->validaNome($this->getNomeCompleto()) &&
                $this->validacao->validarEmail($this->getEmail())
            ) {
                $this->setStatus('Ativo');
                $dados = [
                    $this->getIdAtendente(),
                    $this->getNomeCompleto(),
                    $this->getCidade(),
                    $this->getRua(),
                    $this->getBairro(),
                    $this->getNumero(),
                    $this->getComplemento(),
                    $this->getTelefone(),
                    $this->getEmail(),
                    $this->getGenero(),
                    $this->getStatus(),
                    $this->getDataNascimento(),
                    $this->getCpf(),
                    $this->getNaturalidade(),
                    $this->getIdade(),
                    $this->getAlergia(),
                    $this->getHistoricoCirurgia(),
                    $this->getContatoEmergencia()
                ];

                $sql = "INSERT INTO $this->nomeTabela 
                        (id_atendente, nomeCompleto, cidade, rua, bairro, numero, complemento, telefone, email, genero, status, dataNascimento, cpf, naturalidade, idade, alergia, historicoCirurgia, contatoEmergencia)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                if (Db::preparar($sql)->execute($dados)) {
                    $this->id = Db::conectar()->lastInsertId();
                    (new Telefone_Paciente(['telefone' => $this->getTelefone(), 'id_pessoa' => $this->getId()]))->inserirDados();
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Throwable $e) {
            echo $e;
            return false;
        }
    }



    function atualizarDados($id) {}

    function atualizarStatusPaciente($id)
    {
        $sql = "UPDATE $this->nomeTabela SET status ='consultando' WHERE id = $id";
        if (Db::preparar($sql)->execute())
            return true;
        return false;
    }


    public function selecionarPorStatus($status)
    {
        $sql = "SELECT * FROM $this->nomeTabela WHERE status = ? ORDER BY nomeCompleto";
        $query = self::preparar($sql);
        $query->execute([$status]);
        $res = $query->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAlergia(): ?string
    {
        return $this->alergia;
    }

    public function setAlergia(?string $alergia): void
    {
        $this->alergia = $alergia;
    }

    public function getHistoricoCirurgia(): ?string
    {
        return $this->historicoCirurgia;
    }

    public function setHistoricoCirurgia(?string $historicoCirurgia): void
    {
        $this->historicoCirurgia = $historicoCirurgia;
    }

    public function getContatoEmergencia(): ?string
    {
        return $this->contatoEmergencia;
    }

    public function setContatoEmergencia(?string $contatoEmergencia): void
    {
        $this->contatoEmergencia = $contatoEmergencia;
    }
    public function getIdAtendente(): int
    {
        return $this->id_atendente;
    }
    public function setIdAtendente(int $id_atendente): void
    {
        $this->id_atendente = $id_atendente;
    }
}