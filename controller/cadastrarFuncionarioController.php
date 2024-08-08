<?php
require_once('../vendor/autoload.php');

use sistema\Funcionario as Funcionario;
use sistema\nucleo\Helpers;

if (isset($_POST) && !empty($_POST)) {

    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);


    $dadosFunc = [
        'nome' => $input['nome'] ?? null,
        'dataNascimento' => $input['data_nascimento'] ?? null,
        'sexo' => $input['sexo'] ?? null,
        'telefone' => $input['telefone'] ?? null,
        'email' => $input['email'] ?? null,
        'cargo' => $input['cargo'] ?? null,
        'departamento' => $input['departamento'] ?? null,
        'dataAdmissao' => $input['data_admissao'] ?? null,
        'salario' => $input['salario'] ?? null,
        'numeroRegistroProfissional' => $input['numeroRegistroProfissional'] ?? null,
        'statusEmprego' => $input['status_emprego'] ?? null,
    ];

    (new Funcionario($dadosFunc))->inserirDados();
} else {

    ////////////////////////////////////////////////////////
}