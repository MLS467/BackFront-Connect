<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Login;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;

if (isset($_POST) && !empty($_POST)) {

    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);

    $token = sha1(uniqid() . date("d-m-Y-H-i-s"));

    $cargo = (!empty($_POST['cargo']) ? $_POST['cargo'] : null);

    $dados = [
        'nomeTabela' => Helpers::retornaCargo($cargo),
        'email' => $input['email'],
        'senha' => $input['senha'],
        'token' => $token
    ];

    $login = new Login($dados);
    if ($login->isAutenticado($login->getToken()))
        $login->redirecionar();
    try {
        $login->isAutenticar();
        if ($login->isAutenticado($login->getToken()))
            $login->redirecionar();
        else {
            header("Location:" . Helpers::getServer('login'));
        }
    } catch (PDOException $e) {
        if ($_SERVER["SERVER_NAME"] == 'localhost') {
            (new Mensagem())->msg($e->getMessage())->erro();
        } else {

            header("Location:" . Helpers::getServer('login'));
        }
    }
} else {

    header("Location:" . Helpers::getServer('login'));
}