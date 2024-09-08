<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\Helpers;
use sistema\Paciente;

$id = $_GET['idPacienteEncontrado'];


if (!empty($id) && isset($id)) {
    if ((new Paciente((new Paciente())->selecionarUmRegistro($id)))->inserirDados()) {
        header("Location:" . Helpers::getServer('consultar_dados'));
    } else {
        echo json_encode(['erro' => 'Não foi possível inserir']);
    }
}