<?php
// validado
namespace sistema;

use sistema;

use PDO;
use PDOException;
use sistema\nucleo\Validacao;

class DadosBasicos extends Crud
{
    private int $id;
    private ?int $id_atendente_fk;
    // Informações básicas
    private ?string $nome = null;
    private ?string $cpf = null;
    private ?int $idade = null;
    private ?string $contatoEmergencia = null;

    // Histórico Médico
    private ?string $condicoesMedicas = null;
    private ?string $alergias = null;
    private ?string $medicamentosEmUso = null;
    private ?string $historicoDeCirurgia = null;

    // Detalhes da Visita
    private ?string $dataHoraChegada = null;
    private ?string $motivoDaVisita = null;

    private ?string $obsAdicionais = null;

    private Validacao $validacao;

    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'dados_basicos';

        $this->id_atendente_fk = $dados['id_atendente_fk'] ?? null;
        // Informações Básicas
        $this->nome = $dados['nome'] ?? null;
        $this->cpf = $dados['cpf'] ?? null;
        $this->idade = isset($dados['idade']) ? (int)$dados['idade'] : null;
        $this->contatoEmergencia = $dados['contato_emergencia'] ?? null;

        // Histórico Médico
        $this->condicoesMedicas = $dados['condicoes_medicas'] ?? null;
        $this->alergias = $dados['alergias'] ?? null;
        $this->medicamentosEmUso = $dados['medicamentos_em_uso'] ?? null;
        $this->historicoDeCirurgia = $dados['historico_de_cirurgia'] ?? null;

        // Detalhes da Visita
        $this->dataHoraChegada = $dados['data_hora_chegada'] ?? null;
        $this->motivoDaVisita = $dados['motivo_da_visita'] ?? null;

        // Avaliação de Sintomas

        $this->obsAdicionais = $dados['observacoes'] ?? null;
        $this->validacao = new Validacao();
    }

    public function inserirDados()
    {
        try {
            if ($this->validacao->validaNome($this->nome)) {

                $sql = "INSERT INTO $this->nomeTabela VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

                $query = Db::preparar($sql);
                $query->execute(array(
                    null,
                    $this->getIdAtendenteFk(),
                    $this->getNome(),
                    $this->getCpf(),
                    $this->getIdade(),
                    $this->getContatoEmergencia(),
                    $this->getCondicoesMedicas(),
                    $this->getAlergias(),
                    $this->getMedicamentosEmUso(),
                    $this->getHistoricoDeCirurgia(),
                    $this->getDataHoraChegada(),
                    $this->getMotivoDaVisita(),
                    $this->getObsAdicionais()
                ));
                if ($query) {
                    $this->setId(Db::conectar()->lastInsertId());
                    return true;
                }
                return false;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function atualizarDados($id)
    {
        // Implementar lógica de atualização se necessário
    }
    // Getter e Setter para id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Getter e Setter para id_atendente_fk
    public function getIdAtendenteFk(): int
    {
        return $this->id_atendente_fk;
    }

    public function setIdAtendenteFk(int $id_atendente_fk): void
    {
        $this->id_atendente_fk = $id_atendente_fk;
    }

    // Getter e Setter para nome
    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): void
    {
        $this->nome = $nome;
    }

    // Getter e Setter para cpf
    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): void
    {
        $this->cpf = $cpf;
    }

    // Getter e Setter para idade
    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(?int $idade): void
    {
        $this->idade = $idade;
    }

    // Getter e Setter para contatoEmergencia
    public function getContatoEmergencia(): ?string
    {
        return $this->contatoEmergencia;
    }

    public function setContatoEmergencia(?string $contatoEmergencia): void
    {
        $this->contatoEmergencia = $contatoEmergencia;
    }

    // Getter e Setter para condicoesMedicas
    public function getCondicoesMedicas(): ?string
    {
        return $this->condicoesMedicas;
    }

    public function setCondicoesMedicas(?string $condicoesMedicas): void
    {
        $this->condicoesMedicas = $condicoesMedicas;
    }

    // Getter e Setter para alergias
    public function getAlergias(): ?string
    {
        return $this->alergias;
    }

    public function setAlergias(?string $alergias): void
    {
        $this->alergias = $alergias;
    }

    // Getter e Setter para medicamentosEmUso
    public function getMedicamentosEmUso(): ?string
    {
        return $this->medicamentosEmUso;
    }

    public function setMedicamentosEmUso(?string $medicamentosEmUso): void
    {
        $this->medicamentosEmUso = $medicamentosEmUso;
    }

    // Getter e Setter para historicoDeCirurgia
    public function getHistoricoDeCirurgia(): ?string
    {
        return $this->historicoDeCirurgia;
    }

    public function setHistoricoDeCirurgia(?string $historicoDeCirurgia): void
    {
        $this->historicoDeCirurgia = $historicoDeCirurgia;
    }

    // Getter e Setter para dataHoraChegada
    public function getDataHoraChegada(): ?string
    {
        return $this->dataHoraChegada;
    }

    public function setDataHoraChegada(?string $dataHoraChegada): void
    {
        $this->dataHoraChegada = $dataHoraChegada;
    }

    // Getter e Setter para motivoDaVisita
    public function getMotivoDaVisita(): ?string
    {
        return $this->motivoDaVisita;
    }

    public function setMotivoDaVisita(?string $motivoDaVisita): void
    {
        $this->motivoDaVisita = $motivoDaVisita;
    }

    // Getter e Setter para obsAdicionais
    public function getObsAdicionais(): ?string
    {
        return $this->obsAdicionais;
    }

    public function setObsAdicionais(?string $obsAdicionais): void
    {
        $this->obsAdicionais = $obsAdicionais;
    }
}