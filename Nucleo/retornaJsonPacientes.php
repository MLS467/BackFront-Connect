<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\Helpers;
use sistema\Paciente;
use sistema\Triagem;

$id = $_GET['id'];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // $id = 81;
    $paciente = Helpers::selecionarDadosTemporarios($id);
    echo json_encode(['paciente' => $paciente]);
} else {

    echo json_encode(['error' => 'ID não fornecido ou vazio.']);
}