<?php
require_once('../vendor/autoload.php');

use  sistema\Paciente as Paciente;
use sistema\Triagem as st;

$cpf = $_SESSION['cpf'];
$dadosTriagem = (new st(null))->selecionarUmRegistro($cpf);

$dados = [
    'nome' => $_POST['nome'] ?? null,
    'dataNascimeto' => $_POST['dataNascimento'] ?? null,
    'sexo' => $_POST['sexo'] ?? null,
    'endereco' => $_POST['endereco'] ?? null,
    'telefone' => $_POST['telefone'] ?? null,
    'email' => $_POST['email'] ?? null
];

if ((new Paciente($dadosTriagem, $dados))->inserirDados()) {
    echo "<pre>";
    print_r($paciente);
    echo "</pre>";
} else {
    echo "Deu ruim";
}