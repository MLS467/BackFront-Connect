<?php
require_once('../vendor/autoload.php');

$cpf = $_SESSION['cpf'];
$triagem = new sistema\Triagem(null);
$dadosTriagem = $triagem->selecionarUmRegistro($cpf);

$dadosFunc = [
    'nome' => $_POST['nome'] ?? null,
    'dataNascimento' => $_POST['data_nascimento'] ?? null,
    'sexo' => $_POST['sexo'] ?? null,
    'telefone' => $_POST['telefone'] ?? null,
    'email' => $_POST['email'] ?? null,
    'cargo' => $_POST['cargo'] ?? null,
    'departamento' => $_POST['departamento'] ?? null,
    'dataAdmissao' => $_POST['data_admissao'] ?? null,
    'salario' => $_POST['salario'] ?? null,
    'numeroRegistroProfissional' => $_POST['numeroRegistroProfissional'] ?? null,
    'statusEmprego' => $_POST['status_emprego'] ?? null,
];

$func = new sistema\Funcionario($dadosTriagem, $dadosFunc);
$func->inserirDados();
echo '<pre>';
print_r($func);
echo '</pre>';