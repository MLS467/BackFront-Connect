<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Login;
use sistema\nucleo\Helpers;

$token = sha1(uniqid() . date("d-m-Y-H-i-s"));
$cargo = $_POST['cargo'];

switch ($cargo) {
    case '1':
        $nomeTabela = 'medico';
        break;
    case '2':
        $nomeTabela = 'enfermeiro';
        break;
    case '3':
        $nomeTabela = 'atendente';
        break;
    case '4':
        $nomeTabela = 'administrador';
        break;
    default:
        echo "Escolha um cargo!";
        break;
}

$dados = [
    'nomeTabela' => $nomeTabela,
    'email' => $_POST['email'],
    'senha' => $_POST['senha'],
    'token' => $token
];

if (isset($_POST) and !empty($_POST)) {

    $login = new Login($dados);

    if ($login->isAutenticar()) {
        if ($login->getToken() == $_SESSION['token'])
            $login->redirecionar();
        else {
            echo new Exception("Token inválido", 1);
        }
    } else {
        header("Location:" . Helpers::getServer('login/1'));
    }
} else {
    header("Location:" . Helpers::getServer('login/1'));
}