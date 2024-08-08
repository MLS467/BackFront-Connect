<?php
// dados validados
namespace sistema;

use PDOException;
use sistema\Funcionario;
use sistema\nucleo\Validacao;

class Atendente extends Funcionario
{

    private int $id;
    private ?string $dataInicioTrabalho;
    private ?string $areaAtuacao;
    private Validacao $validacao;

    public function __construct(?array $dados)
    {
        parent::__construct($dados);
        $this->nomeTabela = 'atendente';
        $this->dataInicioTrabalho = $dados['dataInicioTrabalho'];
        $this->areaAtuacao = $dados['areaAtuacao'];
        $this->validacao = new Validacao();
    }


    function inserirDados(): bool | string
    {
        try {
            // Valida os dados
            if (
                $this->validacao->validaNome($this->getNomeCompleto()) &&
                $this->validacao->validarEmail($this->getEmail()) &&
                $this->validacao->validarTelefone($this->getTelefone()) &&
                $this->validacao->validarData($this->getDataRegistro()) &&
                $this->validacao->validarData($this->getDataInicioTrabalho())
            ) {
                // Dados a serem inseridos
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
                    $this->getDataRegistro(),
                    $this->getStatus(),
                    $this->getDataInicioTrabalho(),
                    $this->getAreaAtuacao()
                ];

                // SQL para inserção
                $sql = "INSERT INTO $this->nomeTabela (nome, cidade, rua, bairro, numero, complemento, telefone, email, genero, data_registro, status, data_inicio_trabalho, area_atuacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                // Preparar e executar a consulta
                $stmt = Db::preparar($sql);
                if ($stmt->execute($dados)) {
                    $this->setId(Db::conectar()->lastInsertId());
                    return true;
                } else {
                    return false;
                }
            } else {
                return "Dados inválidos fornecidos.";
            }
        } catch (PDOException $e) {
            // Retorna a mensagem de erro em caso de exceção
            return $e->getMessage();
        }
    }


    function atualizarDados($id)
    {
    }

    // Getter para id
    public function getId(): int
    {
        return $this->id;
    }

    // Setter para id
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Getter para dataInicioTrabalho
    public function getDataInicioTrabalho(): ?string
    {
        return $this->dataInicioTrabalho;
    }

    // Setter para dataInicioTrabalho
    public function setDataInicioTrabalho(?string $dataInicioTrabalho): void
    {
        $this->dataInicioTrabalho = $dataInicioTrabalho;
    }

    // Getter para areaAtuacao
    public function getAreaAtuacao(): ?string
    {
        return $this->areaAtuacao;
    }

    // Setter para areaAtuacao
    public function setAreaAtuacao(?string $areaAtuacao): void
    {
        $this->areaAtuacao = $areaAtuacao;
    }
}