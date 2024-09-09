<?php

namespace sistema;

use PDOException;
use sistema\Pessoa;
use sistema\nucleo\Helpers;
use sistema\nucleo\Validacao;

class Enfermeiro extends Pessoa
{
    private ?int $id = 0;
    private ?string $registroCoren;
    private ?string $especialidade;
    private ?string $data_inicio_trabalho;
    private ?string $data_termino_trabalho;
    private ?string $img;
    private ?string $cargo;
    private ?Validacao $validacao;

    public function __construct(?array $dados)
    {

        parent::__construct($dados);
        $this->nomeTabela = 'enfermeiro';
        $this->cargo = $this->nomeTabela;
        $this->img = $dados['img'] ?? null;
        $this->data_inicio_trabalho = date("Y-m-d");
        $this->data_termino_trabalho = null;
        $this->registroCoren = $dados['registroCoren'] ?? null;
        $this->especialidade = $dados['especialidade'] ?? null;
        $this->validacao = new Validacao();
    }

    public function inserirDados()
    {
        if (
            $this->validacao->validaNome($this->getNomeCompleto()) &&
            $this->validacao->validarCpf($this->getCpf()) &&
            $this->validacao->validarEmail($this->getEmail()) &&
            $this->validacao->validarTelefone($this->getTelefone()) &&
            $this->validacao->validarData($this->getDataNascimento())
        ) {
            try {
                $dados = [
                    $this->getNomeCompleto(),          // nomeCompleto
                    $this->getCidade(),                // cidade
                    $this->getRua(),                   // rua
                    $this->getBairro(),                // bairro
                    $this->getNumero(),                // numero
                    $this->getComplemento(),           // complemento
                    $this->getTelefone(),              // telefone
                    $this->getEmail(),                 // email
                    $this->getGenero(),                // genero
                    $this->getStatus(),                // status
                    $this->getDataNascimento(),        // dataNascimento
                    $this->getCpf(),                   // cpf
                    $this->getNaturalidade(),          // naturalidade
                    $this->getIdade(),                 // idade
                    $this->getRegistroCoren(),         // registroCoren
                    $this->getEspecialidade(),         // especialidade
                    $this->getDataInicioTrabalho(),    // data_inicio_trabalho
                    $this->getDataTerminoTrabalho(),    // data_termino_trabalho
                    $this->getImg(),
                    $this->getCargo(),
                    '123123'
                ];

                $sql = "INSERT INTO enfermeiro (
                nomeCompleto, cidade, rua, bairro, numero, complemento, telefone, email,
                genero, status, dataNascimento, cpf, naturalidade, idade, registroCoren,
                especialidade, data_inicio_trabalho, data_termino_trabalho,img,cargo,senha
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?
            )";

                $stmt = Db::preparar($sql);
                if ($stmt->execute($dados)) {
                    return true;
                } else
                    return false;
            } catch (\Throwable $e) {
                echo $e;
            }
        } else {
            return false;
        }
    }

    function atualizarDados($id)
    {
        // Query de atualização com placeholders posicionais
        $sql = "UPDATE $this->nomeTabela 
                SET nomeCompleto = ?, cidade = ?, rua = ?, bairro = ?, numero = ?, complemento = ?, telefone = ?, email = ?, genero = ?, status = ?, dataNascimento = ?, cpf = ?, naturalidade = ?, idade = ?, registroCoren = ?, especialidade = ?, data_inicio_trabalho = ?, data_termino_trabalho = ?, img = ?, cargo = ?, senha = ?
                WHERE id = ?";

        // Preparar a query
        $stmt = Db::preparar($sql);

        // Executar a query com os valores recebidos pelos getters
        if ($stmt->execute([
            $this->getNomeCompleto(),          // nomeCompleto
            $this->getCidade(),                // cidade
            $this->getRua(),                   // rua
            $this->getBairro(),                // bairro
            $this->getNumero(),                // numero
            $this->getComplemento(),           // complemento
            $this->getTelefone(),              // telefone
            $this->getEmail(),                 // email
            $this->getGenero(),                // genero
            $this->getStatus(),                // status
            $this->getDataNascimento(),        // dataNascimento
            $this->getCpf(),                   // cpf
            $this->getNaturalidade(),          // naturalidade
            $this->getIdade(),                 // idade
            $this->getRegistroCoren(),         // registroCoren
            $this->getEspecialidade(),         // especialidade
            $this->getDataInicioTrabalho(),    // data_inicio_trabalho
            $this->getDataTerminoTrabalho(),   // data_termino_trabalho
            $this->getImg(),                   // img
            $this->getCargo(),                 // cargo
            '123123',                          // senha fixa
            $id                                // ID do registro a ser atualizado
        ])) {
            return true;
        }

        // Retorna false em caso de falha
        return false;
    }



    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    public function getCargo(): string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): void
    {
        $this->cargo = $cargo;
    }



    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getRegistroCoren(): ?string
    {
        return $this->registroCoren;
    }

    public function setRegistroCoren(?string $registroCoren): void
    {
        $this->registroCoren = $registroCoren;
    }

    public function getEspecialidade(): ?string
    {
        return $this->especialidade;
    }

    public function setEspecialidade(?string $especialidade): void
    {
        $this->especialidade = $especialidade;
    }

    public function getDataInicioTrabalho(): ?string
    {
        return $this->data_inicio_trabalho;
    }

    public function setDataInicioTrabalho(?string $data_inicio_trabalho): void
    {
        $this->data_inicio_trabalho = $data_inicio_trabalho;
    }

    public function getDataTerminoTrabalho(): ?string
    {
        return $this->data_termino_trabalho;
    }

    public function setDataTerminoTrabalho(?string $data_termino_trabalho): void
    {
        $this->data_termino_trabalho = $data_termino_trabalho;
    }
}