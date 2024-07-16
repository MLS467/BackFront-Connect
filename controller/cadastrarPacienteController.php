<?php
require_once('../config/config.php');
require_once('../autoload.php');

$cpf = $_SESSION['cpf'];
$triagem = new Triagem(null);
$dadosTriagem = $triagem->selecionarUmRegistro($cpf);

$dados = [
    'nome' => $_POST['nome'] ?? null,
    'dataNascimeto' => $_POST['dataNascimento'] ?? null,
    'sexo' => $_POST['sexo'] ?? null,
    'endereco' => $_POST['endereco'] ?? null,
    'telefone' => $_POST['telefone'] ?? null,
    'email' => $_POST['email'] ?? null
];


$paciente = new Paciente($dadosTriagem, $dados);

if ($paciente->inserirDados()) {
    echo "Dados inseridos";
} else {
    echo "Deu ruim";
}