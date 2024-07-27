<?php

namespace sistema;

require_once('Crud.php');
require_once('Db.php');

use PDO;

class Triagem extends Crud
{
    // informações básicas
    private ?string $cpf = null;
    private ?int $idade = null;
    private ?string $contatoEmergencia = null;

    //Histórico Médico
    private ?string $condicoesMedicas = null;
    private ?string $alergias = null;
    private ?string $medicamentosEmUso = null;
    private ?string $historicoDeCirurgia = null;

    //Detalhes da Visita
    private ?string $dataHoraChegada = null;
    private ?string $motivoDaVisita = null;

    //Avaliacão de Sintomas
    private ?string $sintomaAtuais = null;
    private ?int $gravidadeDosSintomas = null;
    private ?string $tempoDosSintomas = null;
    private ?string $localizacaoDor = null;
    private ?string $sintomasAssociados = null;

    //Sinais Vitais
    private ?string $pressaoArterial = null;
    private ?int $frequenciaCardiaca = null;
    private ?float $temperaturaCorporal = null;
    private ?int $saturacaoDeOxigenio = null;
    private ?int $frequenciaRespiratoria = null;

    //Avaliacao da dor
    private ?int $intensidadeDor = null;
    private ?string $naturezaDor = null;
    private ?string $obsAdicionais = null;


    public function __construct(?array $dados)
    {
        $this->nomeTabela = 'triagem';
        // Informações Básicas
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
        $this->sintomaAtuais = $dados['sintomas'] ?? null;
        $this->gravidadeDosSintomas = isset($dados['gravidade']) ? (int)$dados['gravidade'] : null;
        $this->tempoDosSintomas = $dados['tempo_inicio'] ?? null;
        $this->localizacaoDor = $dados['localizacao_dor'] ?? null;
        $this->sintomasAssociados = $dados['sintomas_associados'] ?? null;

        // Sinais Vitais
        $this->pressaoArterial = $dados['pressao_arterial'] ?? null;
        $this->frequenciaCardiaca = $dados['frequencia_cardiaca'] ?? null;
        $this->temperaturaCorporal = $dados['temperatura'] ?? null;
        $this->saturacaoDeOxigenio = $dados['saturacao'] ?? null;
        $this->frequenciaRespiratoria = $dados['frequencia_respiratoria'] ?? null;

        // Avaliação da Dor
        $this->intensidadeDor = isset($dados['intensidade_dor']) ? (int)$dados['intensidade_dor'] : null;
        $this->naturezaDor = $dados['natureza_dor'] ?? null;
        $this->obsAdicionais = $dados['observacoes'] ?? null;
    }


    public function inserirDados()
    {
        $sql = "INSERT INTO $this->nomeTabela 
                (cpf, idade,contato_emergencia, condicoes_medicas, alergias, medicamentos_em_uso, historico_de_cirurgia, 
                data_hora_chegada, motivo_visita, sintomas_atuais, gravidade_sintomas, tempo_sintomas, localizacao_dor, sintomas_associados, 
                pressao_arterial, frequencia_cardiaca, temperatura_corporal, saturacao_oxigenio, frequencia_respiratoria, intensidade_dor, 
                natureza_dor, obs_adicionais)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $query = Db::preparar($sql);
        $query->execute(array(
            $this->getCpf(),
            $this->getIdade(),
            $this->getContatoEmergencia(),
            $this->getCondicoesMedicas(),
            $this->getAlergias(),
            $this->getMedicamentosEmUso(),
            $this->getHistoricoDeCirurgia(),
            $this->getDataHoraChegada(),
            $this->getMotivoDaVisita(),
            $this->getSintomaAtuais(),
            $this->getGravidadeDosSintomas(),
            $this->getTempoDosSintomas(),
            $this->getLocalizacaoDor(),
            $this->getSintomasAssociados(),
            $this->getPressaoArterial(),
            $this->getFrequenciaCardiaca(),
            $this->getTemperaturaCorporal(),
            $this->getSaturacaoDeOxigenio(),
            $this->getFrequenciaRespiratoria(),
            $this->getIntensidadeDor(),
            $this->getNaturezaDor(),
            $this->getObsAdicionais()
        ));

        if (!$query)
            return false;
        return true;
    }



    function atualizarDados($id)
    {
    }


    // Getters

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function getIdade(): ?int
    {
        return $this->idade;
    }


    public function getContatoEmergencia(): ?string
    {
        return $this->contatoEmergencia;
    }

    public function getCondicoesMedicas(): ?string
    {
        return $this->condicoesMedicas;
    }

    public function getAlergias(): ?string
    {
        return $this->alergias;
    }

    public function getMedicamentosEmUso(): ?string
    {
        return $this->medicamentosEmUso;
    }

    public function getHistoricoDeCirurgia(): ?string
    {
        return $this->historicoDeCirurgia;
    }

    public function getDataHoraChegada(): ?string
    {
        return $this->dataHoraChegada;
    }

    public function getMotivoDaVisita(): ?string
    {
        return $this->motivoDaVisita;
    }

    public function getSintomaAtuais(): ?string
    {
        return $this->sintomaAtuais;
    }

    public function getGravidadeDosSintomas(): ?int
    {
        return $this->gravidadeDosSintomas;
    }

    public function getTempoDosSintomas(): ?string
    {
        return $this->tempoDosSintomas;
    }

    public function getLocalizacaoDor(): ?string
    {
        return $this->localizacaoDor;
    }

    public function getSintomasAssociados(): ?string
    {
        return $this->sintomasAssociados;
    }

    public function getPressaoArterial(): ?string
    {
        return $this->pressaoArterial;
    }

    public function getFrequenciaCardiaca(): ?string
    {
        return $this->frequenciaCardiaca;
    }

    public function getTemperaturaCorporal(): ?string
    {
        return $this->temperaturaCorporal;
    }

    public function getSaturacaoDeOxigenio(): ?string
    {
        return $this->saturacaoDeOxigenio;
    }

    public function getFrequenciaRespiratoria(): ?string
    {
        return $this->frequenciaRespiratoria;
    }

    public function getIntensidadeDor(): ?int
    {
        return $this->intensidadeDor;
    }

    public function getNaturezaDor(): ?string
    {
        return $this->naturezaDor;
    }

    public function getObsAdicionais(): ?string
    {
        return $this->obsAdicionais;
    }

    // Setters

    public function setCpf(?string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function setIdade(?int $idade): void
    {
        $this->idade = $idade;
    }


    public function setContatoEmergencia(?string $contatoEmergencia): void
    {
        $this->contatoEmergencia = $contatoEmergencia;
    }

    public function setCondicoesMedicas(?string $condicoesMedicas): void
    {
        $this->condicoesMedicas = $condicoesMedicas;
    }

    public function setAlergias(?string $alergias): void
    {
        $this->alergias = $alergias;
    }

    public function setMedicamentosEmUso(?string $medicamentosEmUso): void
    {
        $this->medicamentosEmUso = $medicamentosEmUso;
    }

    public function setHistoricoDeCirurgia(?string $historicoDeCirurgia): void
    {
        $this->historicoDeCirurgia = $historicoDeCirurgia;
    }

    public function setDataHoraChegada(?string $dataHoraChegada): void
    {
        $this->dataHoraChegada = $dataHoraChegada;
    }

    public function setMotivoDaVisita(?string $motivoDaVisita): void
    {
        $this->motivoDaVisita = $motivoDaVisita;
    }

    public function setSintomaAtuais(?string $sintomaAtuais): void
    {
        $this->sintomaAtuais = $sintomaAtuais;
    }

    public function setGravidadeDosSintomas(?int $gravidadeDosSintomas): void
    {
        $this->gravidadeDosSintomas = $gravidadeDosSintomas;
    }

    public function setTempoDosSintomas(?string $tempoDosSintomas): void
    {
        $this->tempoDosSintomas = $tempoDosSintomas;
    }

    public function setLocalizacaoDor(?string $localizacaoDor): void
    {
        $this->localizacaoDor = $localizacaoDor;
    }

    public function setSintomasAssociados(?string $sintomasAssociados): void
    {
        $this->sintomasAssociados = $sintomasAssociados;
    }

    public function setPressaoArterial(?string $pressaoArterial): void
    {
        $this->pressaoArterial = $pressaoArterial;
    }

    public function setFrequenciaCardiaca(?string $frequenciaCardiaca): void
    {
        $this->frequenciaCardiaca = $frequenciaCardiaca;
    }

    public function setTemperaturaCorporal(?string $temperaturaCorporal): void
    {
        $this->temperaturaCorporal = $temperaturaCorporal;
    }

    public function setSaturacaoDeOxigenio(?string $saturacaoDeOxigenio): void
    {
        $this->saturacaoDeOxigenio = $saturacaoDeOxigenio;
    }

    public function setFrequenciaRespiratoria(?string $frequenciaRespiratoria): void
    {
        $this->frequenciaRespiratoria = $frequenciaRespiratoria;
    }

    public function setIntensidadeDor(?int $intensidadeDor): void
    {
        $this->intensidadeDor = $intensidadeDor;
    }

    public function setNaturezaDor(?string $naturezaDor): void
    {
        $this->naturezaDor = $naturezaDor;
    }

    public function setObsAdicionais(?string $obsAdicionais): void
    {
        $this->obsAdicionais = $obsAdicionais;
    }
}