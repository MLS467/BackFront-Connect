<?php

namespace sistema;

use sistema\Crud;
use sistema\Db;
use sistema\Triagem;

class SinaisVitais extends Crud
{
    private ?array $triagem;
    private ?string $sintomas;
    private ?string $gravidade;
    private ?string $tempo_inicio;
    private ?string $localizacao_dor;
    private ?string $pressao_arterial;
    private ?string $frequencia_cardiaca;
    private ?string $temperatura;
    private ?string $saturacao;
    private ?string $frequencia_respiratoria;
    private ?string $intensidade_da_dor;
    private ?string $observacoes;
    private ?string $natureza_dor;
    private ?string $id_triagem;
    private ?string $cpf;

    public function __construct(?array $dados, ?array $triagem)
    {
        $this->nomeTabela = 'sinais_vitais';
        $this->triagem = $triagem ?? null;
        $this->id_triagem = $triagem['id'] ?? null;
        $this->cpf = $triagem['cpf'] ?? null;
        $this->sintomas = $dados['sintomas'] ?? null;
        $this->gravidade = $dados['gravidade'] ?? null;
        $this->tempo_inicio = $dados['tempo_inicio'] ?? null;
        $this->localizacao_dor = $dados['localizacao_dor'] ?? null;
        $this->pressao_arterial = $dados['pressao_arterial'] ?? null;
        $this->frequencia_cardiaca = $dados['frequencia_cardiaca'] ?? null;
        $this->temperatura = $dados['temperatura'] ?? null;
        $this->saturacao = $dados['saturacao'] ?? null;
        $this->frequencia_respiratoria = $dados['frequencia_respiratoria'] ?? null;
        $this->intensidade_da_dor = $dados['intensidade_da_dor'] ?? null;
        $this->observacoes = $dados['observacoes'] ?? null;
        $this->natureza_dor = $dados['natureza_dor'] ?? null;
    }


    public function inserirDados()
    {
        $sql = "INSERT INTO $this->nomeTabela (triagem_id, sintomas, gravidade, tempo_inicio, localizacao_dor, pressao_arterial, frequencia_cardiaca, temperatura, saturacao, frequencia_respiratoria, intensidade_da_dor, observacoes, natureza_dor, id_triagem, cpf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepara a instrução
        $stmt = Db::preparar($sql);

        // Executa a instrução com os valores
        $result = $stmt->execute(array(
            $this->id_triagem,
            $this->sintomas,
            $this->gravidade,
            $this->tempo_inicio,
            $this->localizacao_dor,
            $this->pressao_arterial,
            $this->frequencia_cardiaca,
            $this->temperatura,
            $this->saturacao,
            $this->frequencia_respiratoria,
            $this->intensidade_da_dor,
            $this->observacoes,
            $this->natureza_dor,
            $this->id_triagem,
            $this->cpf
        ));

        // Verifica se a execução foi bem-sucedida
        return $result;
    }


    public function atualizarDados($id)
    {
    }

    public function pegaCpf(string $cpf)
    {
        $sql = "SELECT SV.id FROM $this->nomeTabela AS SV
        JOIN triagem AS T
        ON(SV.id_triagem = T.id)
        WHERE T.cpf = ?
        LIMIT 1";

        $stmt = Db::preparar($sql);

        // Execute a consulta
        $stmt->execute(array($cpf));

        // Retorne o resultado
        return $stmt->fetch();
    }
}