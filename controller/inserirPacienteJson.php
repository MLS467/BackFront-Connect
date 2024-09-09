<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\Helpers;
use sistema\Paciente;
// pega id vindo da requisição do javascript
$id = $_GET['idPacienteEncontrado'];

//insere o paciente já existente para ser atendido na triagem
if (!empty($id) && isset($id)) {
    if ((new Paciente((new Paciente())->selecionarUmRegistro($id)))->inserirDados()) {
        header("Location:" . Helpers::getServer('consultar_dados'));
    } else {
        echo json_encode(['erro' => 'Não foi possível inserir']);
    }
}