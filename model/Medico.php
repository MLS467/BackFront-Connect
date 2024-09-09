<?php

namespace sistema;

use PDOException;
use sistema\nucleo\Validacao;
use sistema\Pessoa;
use sistema\Telefone_Funcionario;

class Medico extends Pessoa
{
    private int $id = 0;
    private ?string $especialidade;
    private ?string $CRM;
    private string $data_inicio_trabalho;
    private ?string $data_termino_trabalho;
    private ?string $observacoes;
    private ?string $img;
    private ?string $cargo;
    private ?Validacao $validacao;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->nomeTabela = 'medico';
        $this->cargo = $this->nomeTabela;
        $this->img = $dados['img'] ?? null;
        $this->especialidade = $dados['especialidade'] ?? null;
        $this->CRM = $dados['CRM'] ?? null;
        $this->data_inicio_trabalho = date("Y-m-d");
        $this->data_termino_trabalho = null;
        $this->validacao = new Validacao();
    }

    public function inserirDados(): bool|string
    {
        if (
            $this->validacao->validaNome($this->getNomeCompleto()) &&
            $this->validacao->validarCpf($this->getCpf()) &&
            $this->validacao->validarEmail($this->getEmail()) &&
            $this->validacao->validarTelefone($this->getTelefone()) &&
            $this->validacao->validarData($this->getDataNascimento())
        ) {
            try {

                $sql = "INSERT INTO $this->nomeTabela (nomeCompleto, cidade, rua, bairro, numero, complemento, telefone, email, genero, status, dataNascimento,idade ,cpf, naturalidade, especialidade, CRM, senha,img,cargo) VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
                $dados = [
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
                    $this->getIdade(),
                    $this->getCpf(),
                    $this->getNaturalidade(),
                    $this->getEspecialidade(),
                    $this->getCRM(),
                    '123123',
                    $this->getImg(),
                    $this->getCargo()
                ];


                $stmt = Db::preparar($sql);
                $resultado = $stmt->execute($dados);


                if ($resultado) {
                    $this->setId(Db::conectar()->lastInsertId());

                    (new Telefone_Funcionario(
                        [
                            'telefone' => $this->getTelefone(),
                            'id_funcionario' => $this->getId()
                        ]
                    ))->inserirDados();

                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            return false;
        }
    }


    function atualizarDados($id)
    {
        $sql = "UPDATE $this->nomeTabela 
                SET nomeCompleto = ?, cidade = ?, rua = ?, bairro = ?, numero = ?, complemento = ?, telefone = ?, email = ?, genero = ?, status = ?, dataNascimento = ?, cpf = ?, naturalidade = ?, especialidade = ?, CRM = ?, senha = '123123', img = ?, cargo = ?
                WHERE id = ?";

        $stmt = Db::preparar($sql);

        if ($stmt->execute([
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
            $this->getEspecialidade(),
            $this->getCRM(),
            $this->getImg(),
            $this->getCargo(),
            $id
        ])) {
            return true;
        }

        return false;
    }




    public function getCargo(): string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): void
    {
        $this->cargo = $cargo;
    }


    public function getImg(): string
    {
        return $this->img;
    }


    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getEspecialidade(): ?string
    {
        return $this->especialidade;
    }


    public function setEspecialidade(?string $especialidade): void
    {
        $this->especialidade = $especialidade;
    }


    public function getCRM(): ?string
    {
        return $this->CRM;
    }


    public function setCRM(?string $CRM): void
    {
        $this->CRM = $CRM;
    }

    public function getObservacoes(): ?string
    {
        return $this->observacoes;
    }


    public function setObservacoes(?string $observacoes): void
    {
        $this->observacoes = $observacoes;
    }

    public function getDataInicioTrabalho(): ?string
    {
        return $this->data_inicio_trabalho;
    }

    // Setter para data_inicio_trabalho
    public function setDataInicioTrabalho(?string $data_inicio_trabalho): void
    {
        $this->data_inicio_trabalho = $data_inicio_trabalho;
    }

    // Getter para data_termino_trabalho
    public function getDataTerminoTrabalho(): ?string
    {
        return $this->data_termino_trabalho;
    }

    // Setter para data_termino_trabalho
    public function setDataTerminoTrabalho(?string $data_termino_trabalho): void
    {
        $this->data_termino_trabalho = $data_termino_trabalho;
    }
}