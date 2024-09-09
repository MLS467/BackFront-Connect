<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\DadosTemporarios;
use sistema\Triagem;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;
// pega o id do funcionario após o login
$idEnfermeiro = $_SESSION['idFuncionario'];


if (isset($_POST) && !empty($_POST)) {
    // testa e limpa os dados 
    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);
    // estrutura os dados para serem inseridos
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
    // insere dados da triagem e redireciona para visualizar_registro
    if ($triagem->inserirDados()) {
        $dadosTemp = new DadosTemporarios();
        // se inseridos os dados os dados temporários são lidos para atualização
        $id_dt = $dadosTemp->lerTodosPorStatus('em_progresso');
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