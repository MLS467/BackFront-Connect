<?php
require_once('../vendor/autoload.php');

use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;
use sistema\Paciente;

if (isset($_POST) && !empty($_POST)) {

    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);

    $dados = [
        'nome' => $input['nome'] ?? null,
        'rua' => $input['rua'] ?? null,
        'bairro' => $input['bairro'] ?? null,
        'numero' => $input['numero'] ?? null,
        'complemento' => $input['complemento'] ?? null,
        'dataNascimento' => $input['dataNascimento'] ?? null,
        'sexo' => $input['sexo'] ?? null,
        'endereco' => $input['endereco'] ?? null,
        'telefone' => $input['telefone'] ?? null,
        'email' => $input['email'] ?? null,
        'naturalidade' => $input['Naturalidade'] ?? null,
    ];
    // $teste = new Paciente($dados);
    // Helpers::mostrarArray(null, $teste);

    try {
        $paciente = new Paciente($dados);

        if ($paciente->inserirDados()) {
            (new DadosTemporarios(null))->criar($paciente->getId(), 'Paciente');
            header('Location:fichaAtendimentoController.php');
        } else {
            echo "ERRO";
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