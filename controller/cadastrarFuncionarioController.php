<?php
require_once('../vendor/autoload.php');

// $cpf = $_SESSION['cpf'];
// $triagem = new sistema\Triagem(null);
// $dadosTriagem = $triagem->selecionarUmRegistro($cpf);

use sistema\Funcionario as Funcionario;

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

(new Funcionario($dadosFunc))->inserirDados();