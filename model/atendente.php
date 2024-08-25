<?php
// dados validados
namespace sistema;

use PDOException;
use sistema\Pessoa;
use sistema\nucleo\Validacao;

class Atendente extends Pessoa
{

    private int $id;
    private string $data_inicio_trabalho;
    private ?string $data_termino_trabalho;
    private Validacao $validacao;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->data_inicio_trabalho = date("Y-m-d");
        $this->data_termino_trabalho = null;
        $this->nomeTabela = 'atendente';
        $this->validacao = new Validacao();
    }


    // function inserirDados(): bool | string
    // {
    //     try {
    //         // Valida os dados
    //         if (
    //             $this->validacao->validaNome($this->getNomeCompleto()) &&
    //             $this->validacao->validarEmail($this->getEmail()) &&
    //             $this->validacao->validarTelefone($this->getTelefone()) &&
    //             $this->validacao->validarData($this->getDataInicioTrabalho())
    //         ) {
    //             // Dados a serem inseridos
    //             $dados = [
    //                 $this->getNomeCompleto(),
    //                 $this->getCidade(),
    //                 $this->getRua(),
    //                 $this->getBairro(),
    //                 $this->getNumero(),
    //                 $this->getComplemento(),
    //                 $this->getTelefone(),
    //                 $this->getEmail(),
    //                 $this->getGenero(),
    //                 $this->getDataRegistro(),
    //                 $this->getStatus(),
    //                 $this->getDataInicioTrabalho(),
    //                 $this->getAreaAtuacao()
    //             ];

    //             // SQL para inserção
    //             $sql = "INSERT INTO $this->nomeTabela (nome, cidade, rua, bairro, numero, complemento, telefone, email, genero, data_registro, status, data_inicio_trabalho, area_atuacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    //             // Preparar e executar a consulta
    //             $stmt = Db::preparar($sql);
    //             if ($stmt->execute($dados)) {
    //                 $this->setId(Db::conectar()->lastInsertId());
    //                 return true;
    //             } else {
    //                 return false;
    //             }
    //         } else {
    //             return "Dados inválidos fornecidos.";
    //         }
    //     } catch (PDOException $e) {
    //         // Retorna a mensagem de erro em caso de exceção
    //         return $e->getMessage();
    //     }
    // }


    function atualizarDados($id) {}


    public function getId(): int
    {
        return $this->id;
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