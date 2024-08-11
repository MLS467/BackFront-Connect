<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\FichaAtendimento;
use sistema\nucleo\Helpers;
use sistema\Paciente;
use sistema\SinaisVitais;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    // $id = 19;
    $paciente = (new FichaAtendimento(null))->lerTodosDados($id);
    $_SESSION['id_fa'] = $paciente['id_ficha_Atendimento'];
    // Helpers::mostrarArray($paciente, null);
    echo json_encode(['paciente' => $paciente]);
} else {

    echo json_encode(['error' => 'ID não fornecido ou vazio.']);
}