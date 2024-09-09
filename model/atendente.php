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
    private ?string $img;
    private ?string $cargo;
    private Validacao $validacao;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->img = $dados['img'] ?? null;
        $this->nomeTabela = 'atendente';
        $this->cargo = $this->nomeTabela;
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
         (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

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
                    null,
                    $this->getNaturalidade(),
                    $this->getIdade(),
                    $this->getDataInicioTrabalho(),
                    $this->getDataTerminoTrabalho(),
                    '123123',
                    null,
                    $this->getImg(),
                    $this->getCargo()
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

    function atualizarDados($id)
    {
        // Query de atualização com placeholders posicionais
        $sql = "UPDATE $this->nomeTabela 
                SET nomeCompleto = ?, cidade = ?, rua = ?, bairro = ?, numero = ?, complemento = ?, telefone = ?, email = ?, genero = ?, status = ?, dataNascimento = ?, cpf = ?, naturalidade = ?, idade = ?, senha = ?, img = ?, cargo = ?
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
            '123123',                          // senha fixa
            $this->getImg(),                   // img
            $this->getCargo(),                 // cargo
            $id                                // ID do registro a ser atualizado
        ])) {
            return true;
        }

        // Retorna false em caso de falha
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
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