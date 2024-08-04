<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\DadosTemporarios;
use sistema\SinaisVitais;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;


$idEnfermeiro = 1;

$dados = array(
    'id_enfermeiro' => $idEnfermeiro,
    'sintomas' => $_POST['sintomas'] ?? '',
    'gravidade' => $_POST['gravidade'] ?? '',
    'tempo_inicio' => $_POST['tempo_inicio'] ?? '',
    'localizacao_dor' => $_POST['localizacao_dor'] ?? '',
    'sintomas_associados' => $_POST['sintomas_associados'] ?? '',
    'pressao_arterial' => $_POST['pressao_arterial'] ?? '',
    'frequencia_cardiaca' => $_POST['frequencia_cardiaca'] ?? '',
    'temperatura' => $_POST['temperatura'] ?? '',
    'saturacao' => $_POST['saturacao'] ?? '',
    'frequencia_respiratoria' => $_POST['frequencia_respiratoria'] ?? '',
    'intensidade_dor' => $_POST['intensidade_dor'] ?? '',
    'observacoes' => $_POST['observacoes'] ?? '',
    'natureza_dor' => $_POST['natureza_dor'] ?? ''
);


// $teste = new SinaisVitais($dados);
// echo '<pre>';
// print_r($teste);
// echo '</pre>';
// $teste->inserirDados();


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