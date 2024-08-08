<?php
require_once('../vendor/autoload.php');



use sistema\nucleo\Helpers;
use sistema\DadosBasicos as DB;
use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Mensagem;

Helpers::mostrarArray($_POST, null);

if (isset($_POST) && isset($_POST['enviar']) && !empty($_POST)) {

    $idAtendente = $_SESSION['id'];

    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);

    $dados = array(
        'nome' => $input['nome'] ?? '',
        'idade' => $input['idade'] ?? '',
        'cpf' => $input['cpf'] ?? '',
        'contato_emergencia' => $input['contato_emergencia'] ?? '',
        'condicoes_medicas' => $input['condicoes_medicas'] ?? '',
        'alergias' => $input['alergias'] ?? '',
        'medicamentos_em_uso' => $input['medicamentos'] ?? '',
        'historico_de_cirurgia' => $input['historico_cirurgias'] ?? '',
        'data_hora_chegada' => $input['data_hora_chegada'] ?? '',
        'motivo_da_visita' => $input['motivo_visita'] ?? '',
        'id_atendente_fk' => $idAtendente
    );


    try {
        $dadosBasicos = new DB($dados);
        if ($dadosBasicos->inserirDados()) {
            if ((new DadosTemporarios())->criar($dadosBasicos->getId(), $dadosBasicos->getId()))
                header("location:" . Helpers::getServer('cadastro_sinais_vitais'));
        } else
            new Exception("Houve um problema para inserir os dados!");
    } catch (PDOException $e) {
        if ($_SERVER["SERVER_NAME"] == 'localhost') {
            (new Mensagem())->msg($e->getMessage())->erro();
        } else {
            Helpers::getServer('404');
        }
    }
} else if (isset($_POST) && isset($_POST['cancelar'])) {
    // (new DadosTemporarios())->deletarTodos();
    // echo 'foi';
    // // header("Location:" . Helpers::getServer('dados_basicos'));
}