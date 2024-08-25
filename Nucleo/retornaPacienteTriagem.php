<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\Paciente;

$id = $_GET['id'];

if ($id and !empty($id)) {
    $paciente = (new Paciente(null))->selecionarUmRegistro($id);
    if ($paciente) {
        $dt = new DadosTemporarios();
        $dt->criar($id, 'Paciente');
        $dt->atualizarStatus($dt->getId(), 2);
        echo json_encode(['paciente' => $paciente, 'status' => true]);
    } else {
        echo json_encode(['status' => false]);
    }
}