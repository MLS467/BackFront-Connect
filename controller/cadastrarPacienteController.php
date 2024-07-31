<?php
require_once('../vendor/autoload.php');

use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;
use  sistema\Paciente as Paciente;
use sistema\SinaisVitais;
use sistema\Triagem;

$cpf = $_SESSION['cpf'];
$teste = (new SinaisVitais(null, null))->pegaCpf($cpf);

$dados = [
    'nome' => $_POST['nome'] ?? null,
    'dataNascimento' => $_POST['dataNascimento'] ?? null,
    'sexo' => $_POST['sexo'] ?? null,
    'endereco' => $_POST['endereco'] ?? null,
    'telefone' => $_POST['telefone'] ?? null,
    'email' => $_POST['email'] ?? null,
    'Naturalidade' => $_POST['Naturalidade'] ?? null,
    'id_triagemCompleta' => $teste->id ?? null
];

try {
    if ((new Paciente($dados))->inserirDados())
        header("Location:" . Helpers::getServer("visualizar"));
} catch (PDOException $e) {
    if (Helpers::getServer() == URL_DESENVOLVIMENTO) {
        echo (new Mensagem())->msg($e->getMessage())->erro();
    } else {
        header("Localhost:404");
    }
}