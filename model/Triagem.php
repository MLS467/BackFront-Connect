<?php

namespace sistema;

require_once('Crud.php');
require_once('Db.php');

use PDO;

class Triagem extends Crud
{
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

    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'triagem';

        // Informações Básicas
        $this->nome = $dados['nome'] ?? null;
        $this->cpf = $dados['cpf'] ?? null;
        $this->idade = isset($dados['idade']) ? (int)$dados['idade'] : null;
        $this->contatoEmergencia = $dados['contato_emergencia'] ?? null;

        // Histórico Médico
        $this->condicoesMedicas = $dados['condicoes_medicas'] ?? null;
        $this->alergias = $dados['alergias'] ?? null;
        $this->medicamentosEmUso = $dados['medicamentos'] ?? null;
        $this->historicoDeCirurgia = $dados['historico_cirurgias'] ?? null;

        // Detalhes da Visita
        $this->dataHoraChegada = $dados['data_hora_chegada'] ?? null;
        $this->motivoDaVisita = $dados['motivo_visita'] ?? null;

        // Avaliação de Sintomas

        $this->obsAdicionais = $dados['observacoes'] ?? null;
    }

    public function inserirDados()
    {
        $sql = "INSERT INTO $this->nomeTabela VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

        $query = Db::preparar($sql);
        $query->execute(array(
            null,
            $this->nome,
            $this->cpf,
            $this->idade,
            $this->contatoEmergencia,
            $this->condicoesMedicas,
            $this->alergias,
            $this->medicamentosEmUso,
            $this->historicoDeCirurgia,
            $this->dataHoraChegada,
            $this->motivoDaVisita,
            $this->obsAdicionais
        ));

        return $query ? true : false;
    }

    function atualizarDados($id)
    {
        // Implementar lógica de atualização se necessário
    }

    // Getters e Setters
    // (Metodos Getters e Setters removidos por brevidade, mas são necessários conforme o seu código atual)

}