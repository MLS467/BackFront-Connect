<?php
require_once('../vendor/autoload.php');

$cpf = $_SESSION['cpf'];
$triagem = new sistema\Triagem(null);
$dadosTriagem = $triagem->selecionarUmRegistro($cpf);

$dados = [
    'nome' => $_POST['nome'] ?? null,
    'dataNascimeto' => $_POST['dataNascimento'] ?? null,
    'sexo' => $_POST['sexo'] ?? null,
    'endereco' => $_POST['endereco'] ?? null,
    'telefone' => $_POST['telefone'] ?? null,
    'email' => $_POST['email'] ?? null
];


$paciente = new sistema\Paciente($dadosTriagem, $dados);

if ($paciente->inserirDados()) {
    echo "<pre>";
    print_r($paciente);
    echo "</pre>";
} else {
    echo "Deu ruim";
}