<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Consulta;
use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;

$id_medico = $_SESSION['id'];

if (isset($_POST) && !empty($_POST)) {

    $fichaAtend = (new DadosTemporarios(null))->lerTodosPorStatus('pendente');
    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);

    $data = [
        'id' => $id_medico,
        'id_ficha_atendimento_fk' => $fichaAtend[0]->id_usuario,
        'id_medico_fk' => $id_medico,
        'dataHora' => $input['dataHora'],
        'diagnostico' => $input['diagnostico'],
        'tratamento' => $input['tratamento'],
        'observacoes' => $input['observacoes'],
        'status' => $input['status']
    ];


    $teste = new Consulta($data);

    if ($teste->inserirDados()) {
        (new DadosTemporarios(null))->deletarTodos();
        echo (new Mensagem())->msg('Consulta Realizada!')->sucesso()->renderizar();
    }
} else {
    /////////////////////////////////////////////////////
}