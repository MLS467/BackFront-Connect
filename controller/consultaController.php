<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Consulta;
use sistema\FichaAtendimento;
use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;

$id_medico = $_SESSION['id'];
$id_fa = $_SESSION['id_fa'];


if (isset($_POST) && !empty($_POST)) {

    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);


    $data = [
        'id' => $id_medico,
        'id_ficha_atendimento_fk' => $id_fa,
        'id_medico_fk' => $id_medico,
        'dataHora' => $input['dataHora'],
        'diagnostico' => $input['diagnostico'],
        'tratamento' => $input['tratamento'],
        'observacoes' => $input['observacoes'],
        'status' => $input['status']
    ];


    $consulta = new Consulta($data);

    if ($consulta->inserirDados()) {
        (new FichaAtendimento(null))->atualizarDados($id_fa);
        (new DadosTemporarios(null))->deletarTodos();
        echo (new Mensagem())->msg('Consulta Realizada!')->sucesso()->renderizar();
    } else {
        /////////////////////////////////////////////////////
    }
}