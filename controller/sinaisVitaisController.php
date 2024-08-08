<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\DadosTemporarios;
use sistema\SinaisVitais;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;

$idEnfermeiro = $_SESSION['id'];

if (isset($_POST) && !empty($_POST)) {
    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    var_dump($input);
    $input = Helpers::limpaArrayPost($input);

    $dados = array(
        'id_enfermeiro' => $idEnfermeiro,
        'sintomas' => $input['sintomas'] ?? '',
        'gravidade' => $input['gravidade'] ?? '',
        'tempo_inicio' => $input['tempo_inicio'] ?? '',
        'localizacao_dor' => $input['localizacao_dor'] ?? '',
        'sintomas_associados' => $input['sintomas_associados'] ?? '',
        'pressao_arterial' => $input['pressao_arterial'] ?? '',
        'frequencia_cardiaca' => $input['frequencia_cardiaca'] ?? '',
        'temperatura' => $input['temperatura'] ?? '',
        'saturacao' => $input['saturacao'] ?? '',
        'frequencia_respiratoria' => $input['frequencia_respiratoria'] ?? '',
        'intensidade_dor' => $input['intensidade_dor'] ?? '',
        'observacoes' => $input['observacoes'] ?? '',
        'natureza_dor' => $input['natureza_dor'] ?? ''
    );


    try {
        $sv = new SinaisVitais($dados);
        if ($sv->inserirDados()) {
            (new DadosTemporarios())->criar($sv->getId(), 'sinais_vitais');
            header("Location:triagemController.php");
        } else {
            echo "Erro ao inserir dados";
        }
    } catch (PDOException $e) {
        if (Helpers::getServer() == URL_DESENVOLVIMENTO) {
            (new Mensagem())->msg($e->getMessage())->erro();
        } else {
            header("Location:" . Helpers::getServer('404'));
        }
    }
} else {
    ////////////////////////////////////////////
}