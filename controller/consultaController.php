<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Consulta;
use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;

$id_medico = 1;
$fichaAtend = (new DadosTemporarios(null))->lerTodosPorStatus('pendente');



$data = [
    'id' => 1,
    'id_ficha_atendimento_fk' => $fichaAtend[0]->id_usuario,
    'id_medico_fk' => $id_medico,
    'dataHora' => $_POST['dataHora'],
    'diagnostico' => $_POST['diagnostico'],
    'tratamento' => $_POST['tratamento'],
    'observacoes' => $_POST['observacoes'],
    'status' => $_POST['status']
];


$teste = new Consulta($data);

if ($teste->inserirDados()) {
    (new DadosTemporarios(null))->deletarTodos();
    echo (new Mensagem())->msg('Consulta Realizada!')->sucesso()->renderizar();
}