<?php
require_once('../vendor/autoload.php');

use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;
use sistema\Paciente;




$dados = [
    'nome' => $_POST['nome'] ?? null,
    'rua' => $_POST['rua'] ?? null,
    'bairro' => $_POST['bairro'] ?? null,
    'numero' => $_POST['numero'] ?? null,
    'complemento' => $_POST['complemento'] ?? null,
    'dataNascimento' => $_POST['dataNascimento'] ?? null,
    'sexo' => $_POST['sexo'] ?? null,
    'endereco' => $_POST['endereco'] ?? null,
    'telefone' => $_POST['telefone'] ?? null,
    'email' => $_POST['email'] ?? null,
    'naturalidade' => $_POST['Naturalidade'] ?? null,
];


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