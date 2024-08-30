<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\DadosTemporarios;
use sistema\Triagem;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;

$idEnfermeiro = $_SESSION['idFuncionario'];


if (isset($_POST) && !empty($_POST)) {

    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);

    $dados = array(
        'id_enfermeiro' => $idEnfermeiro,
        'sintomas' => $input['sintomas'] ?? '',
        'gravidade' => $input['gravidade'] ?? '',
        'tempo_inicio' => $input['tempo_inicio'] ?? '',
        'localizacao_dor' => $input['localizacao_dor'] ?? '',
        'pressao_arterial' => $input['pressao_arterial'] ?? '',
        'frequencia_cardiaca' => $input['frequencia_cardiaca'] ?? '',
        'temperatura' => $input['temperatura'] ?? '',
        'saturacao' => $input['saturacao'] ?? '',
        'frequencia_respiratoria' => $input['frequencia_respiratoria'] ?? '',
        'intensidade_dor' => $input['intensidade_dor'] ?? '',
        'natureza_dor' => $input['natureza_dor'] ?? '',
        'observacoes' => $input['observacoes'] ?? '',
        'medicamento_uso' => $input['medicamento_uso'] ?? ''
    );


    $triagem = new Triagem($dados);
    if ($triagem->inserirDados()) {
        $dadosTemp = new DadosTemporarios();
        $id_dt = $dadosTemp->lerTodosPorStatus('em_processo');
        $dadosTemp->atualizarStatus($id_dt[0]->id, 3);
        if ($dadosTemp->adcTriagem($id_dt[0]->id, $triagem->getId())) {
            header("Location:" . Helpers::getServer('visualizar_registro'));
        } else {
            echo "ERRO";
        };
    } else {
        echo "Erro ao inserir dados";
    }
} else {
    header("Location:" . Helpers::getServer('404'));
}