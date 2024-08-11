<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\nucleo\DadosTemporarios;
use sistema\nucleo\Helpers;
use sistema\Triagem;

$dadosTemp = (new DadosTemporarios(null))->lerTodosPorStatus('pendente');
$dados = [
    'id_dados_basicos_fk' => $dadosTemp[0]->id_usuario,
    'id_sinais_vitais_fk' => $dadosTemp[1]->id_usuario
];

Helpers::mostrarArray($dadosTemp, null);

$triagem = new Triagem($dados);
if ($triagem->inserirDados()) {
    (new DadosTemporarios(null))->deletarTodos();
    (new DadosTemporarios(null))->criar($triagem->getId(), 'triagem');
    header("Location:" . Helpers::getServer('cadastro_paciente'));
} else {
    echo "Erro";
}