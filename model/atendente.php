<?php
// dados validados
namespace sistema;

use PDOException;
use sistema\Pessoa;
use sistema\nucleo\Validacao;
use PDO;

class Atendente extends Pessoa
{

    private int $id;
    private string $data_inicio_trabalho;
    private ?string $data_termino_trabalho;
    private Validacao $validacao;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->nomeTabela = 'atendente';
        $this->data_inicio_trabalho = date("Y-m-d");
        $this->data_termino_trabalho = null;
        $this->validacao = new Validacao();
    }


    public function inserirDados(): bool
    {
        if (
            $this->validacao->validaNome($this->getNomeCompleto()) &&
            $this->validacao->validarCpf($this->getCpf()) &&
            $this->validacao->validarEmail($this->getEmail()) &&
            $this->validacao->validarTelefone($this->getTelefone()) &&
            $this->validacao->validarData($this->getDataNascimento())
        ) {

            $sql = "INSERT INTO $this->nomeTabela VALUES
         (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            try {
                $query = Db::preparar($sql);
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
                    $this->getCpf(),
                    $this->getSexo(),
                    $this->getNaturalidade(),
                    $this->getIdade(),
                    $this->getDataInicioTrabalho(),
                    $this->getDataTerminoTrabalho(),
                    '12313',
                    null
                ];
                $result = $query->execute($dados);

                if ($result) {
                    $this->setId(Db::conectar()->lastInsertId());
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                error_log('Erro ao inserir dados: ' . $e->getMessage());
                return false;
            }
        } else {
            return false;
        }
    }



    function atualizarDados($id) {}


    public function getId(): int
    {
        return $this->id;
    }

    public function getSexo(): null
    {
        return null;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
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