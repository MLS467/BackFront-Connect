<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\FichaAtendimento;
use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;

$id_dados = (new DadosTemporarios)->lerTodosPorStatus('pendente');
$id_triagem_fk = $id_dados[0]->id_usuario;
$id_paciente_fk = $id_dados[1]->id_usuario;

$dados = [
    'idPaciente' => $id_paciente_fk,
    'idTriagem' => $id_triagem_fk
];

$fichaCad = new FichaAtendimento($dados);

if ($fichaCad->inserirDados()) {
    (new DadosTemporarios())->deletarTodos();
    (new DadosTemporarios())->criar($fichaCad->getId(), 'fichaAtendimento');
    header("Location:" . Helpers::getServer('visualizar'));
}