<?php
require_once('../vendor/autoload.php');

use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;
use sistema\Paciente;

$id_atendente = $_SESSION['idFuncionario'];

if (isset($_POST) && !empty($_POST)) {

    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);


    $dados = [
        'id_atendente' => $id_atendente,
        'nomeCompleto' => $_POST['nomeCompleto'] ?? null,
        'cidade' => $_POST['cidade'] ?? null,
        'rua' => $_POST['rua'] ?? null,
        'bairro' => $_POST['bairro'] ?? null,
        'numero' => $_POST['numero'] ?? null,
        'complemento' => $_POST['complemento'] ?? null,
        'telefone' => $_POST['telefone'] ?? null,
        'email' => $_POST['email'] ?? null,
        'status' => $_POST['status'] ?? null,
        'dataNascimento' => $_POST['dataNascimento'] ?? null,
        'cpf' => $_POST['cpf'] ?? null,
        'idade' => $_POST['idade'] ?? null,
        'genero' => $_POST['genero'] ?? null,
        'naturalidade' => $_POST['naturalidade'] ?? null,
        'alergia' => $_POST['alergia'] ?? null,
        'historicoCirurgia' => $_POST['historicoCirurgia'] ?? null,
        'contatoEmergencia' => $_POST['contatoEmergencia'] ?? null
    ];

    try {
        $paciente = new Paciente($dados);

        if ($paciente->inserirDados()) {
            header('Location:' . Helpers::getServer('consultar_dados'));
            exit;
        } else {
            exit;
        }
    } catch (PDOException $e) {
        if (Helpers::getServer() == URL_DESENVOLVIMENTO) {
            echo (new Mensagem())->msg($e->getMessage())->erro();
        } else {
            header("Localhost:404");
        }
    }
} else {
    /////////////////////////////////////////////////////////////
}