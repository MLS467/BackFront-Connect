<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\SinaisVitais as SV;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;
use sistema\Triagem;

$cpf = $_SESSION['cpf'];
$triagem = (new Triagem(null))->selecionarUmRegistro($cpf);

$dados = array(
    'sintomas' => $_POST['sintomas'] ?? '',
    'gravidade' => $_POST['gravidade'] ?? '',
    'tempo_inicio' => $_POST['tempo_inicio'] ?? '',
    'localizacao_dor' => $_POST['localizacao_dor'] ?? '',
    'sintomas_associados' => $_POST['sintomas_associados'] ?? '',
    'pressao_arterial' => $_POST['pressao_arterial'] ?? '',
    'frequencia_cardiaca' => $_POST['frequencia_cardiaca'] ?? '',
    'temperatura' => $_POST['temperatura'] ?? '',
    'saturacao' => $_POST['saturacao'] ?? '',
    'frequencia_respiratoria' => $_POST['frequencia_respiratoria'] ?? '',
    'intensidade_dor' => $_POST['intensidade_dor'] ?? '',
    'observacoes' => $_POST['observacoes'] ?? '',
    'natureza_dor' => $_POST['natureza_dor'] ?? ''
);


try {
    if ((new SV($dados, $triagem))->inserirDados())
        header("Location:" . URL_DESENVOLVIMENTO . "/cadastro_paciente");
} catch (PDOException $e) {
    if (Helpers::getServer() == URL_DESENVOLVIMENTO) {
        (new Mensagem())->msg($e->getMessage())->erro();
    } else {
        header("Location:" . Helpers::getServer('404'));
    }
}