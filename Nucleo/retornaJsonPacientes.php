<?php
require_once __DIR__ . "/../vendor/autoload.php";
use sistema\nucleo\Helpers;
use sistema\Paciente;
use sistema\Triagem;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    // $id = 19;
    $paciente = (new Paciente())->selecionarTodosRegistros();
    $triagem = (new Triagem(null))->selecionarUmRegistro($paciente->)
    echo json_encode(['paciente' => $paciente]);
} else {

    echo json_encode(['error' => 'ID não fornecido ou vazio.']);
}