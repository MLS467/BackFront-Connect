<?php
require_once __DIR__ . "/../vendor/autoload.php";


use sistema\Consulta;
use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;

$id_medico = $_SESSION['idFuncionario'];

$dadosRecuperados = (new DadosTemporarios())->lerTodosPorStatus('concluido');

if (isset($_POST) && !empty($_POST)) {

    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);

    if (!empty($dadosRecuperados[0]) && !empty($id_medico)) {

        $dados = [
            'id_medico' => $id_medico,
            'id_paciente' => $dadosRecuperados[0]->id_paciente,
            'id_triagem' => $dadosRecuperados[0]->id_triagem,
            'dataHora' => $input['dataHora'],
            'diagnostico' => $input['diagnostico'],
            'tratamento' => $input['tratamento'],
            'observacoes' => $input['observacoes'],
            'status' => $input['status']
        ];


        try {
            $consulta = new Consulta($dados);
            if ($consulta->inserirDados()) {
                $dadosConcluidos = (new DadosTemporarios())->lerTodosPorStatus('Paciente/Triagem');
                (new DadosTemporarios())->deletar($dadosRecuperados[0]->id);
                echo (new Mensagem())->msg('Consulta Realizada!')->sucesso()->renderizar();
            } else {
                echo 'ERRO';
            }
        } catch (\Throwable $e) {
            echo $e;
        }
    } else {
        ///// TRATAR ERRO
    }
} else {
    Helpers::getServer('404');
}