<?php
require_once __DIR__ . "/../vendor/autoload.php";

use sistema\Adm;
use sistema\nucleo\Helpers;
use sistema\nucleo\ValidacaoPorMim;


// fazendo sanitização dos dados
$input = filter_input(INPUT_POST, FILTER_DEFAULT);
$input = Helpers::limpaArrayPost($_POST);

// integrando imagens
$img = $_FILES['imgFunc']['name'];
$tmp = $_FILES['imgFunc']['tmp_name'];
$tamanho = $_FILES['imgFunc']['size'];
$path = "../public/assets/img/pic/";

// Helpers::mostrarArray($input);

if (isset($input['cargo']) and isset($input) and !empty($input) and !empty($input['cargo'])) {

    // validação de imagem e upload
    if ((new ValidacaoPorMim())->ValidaArq($img, $tamanho))
        move_uploaded_file($tmp,  $path . $img);
    // insere o nome da imagem no array
    $input['img'] = $img;

    // adicionando um novo usuário
    if ((new Adm(null))->adicionarNovoFuncionario($input['cargo'], $input)) {
        header("Location:" . Helpers::getServer('listar_funcionario'));
    } else {
        echo "Deu ruim 1";
        exit;
    };
} else {
    echo "Deu ruim 2";
    exit;
}