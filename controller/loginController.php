<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Login;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;

// testa se existe o post e se não está vázio
if (isset($_POST) && !empty($_POST)) {
    // faz sanitização dos dados
    $input = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $input = Helpers::limpaArrayPost($input);
    // cria um token aleátorio
    $token = sha1(uniqid() . date("d-m-Y-H-i-s"));

    //teste o cargo para validação
    $cargo = (!empty($_POST['cargo']) ? $_POST['cargo'] : null);
    // conjundo de dados para o login
    $dados = [
        'nomeTabela' => Helpers::retornaCargo($cargo),
        'email' => $input['email'],
        'senha' => $input['senha'],
        'token' => $token
    ];


    $login = new Login($dados);
    try {
        // instanciando o login e testando a autenticação do usuario
        $login->isAutenticar();
        if ($login->isAutenticado($login->getToken()))
            // se for true o valor do token na session com a coluna token do funcionario, será redirecionado
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