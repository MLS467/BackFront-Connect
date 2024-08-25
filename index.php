<?php
require_once "vendor/autoload.php";

use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;


SimpleRouter::setDefaultNamespace('sistema\rotas');

try {
    // ATENDENTE
    SimpleRouter::get(URL_BASE . 'consultar_dados', 'SiteRotas@consultar_dados');
    SimpleRouter::get(URL_BASE . 'cadastro_paciente', 'SiteRotas@cadastrarPaciente');


    //ENFERMEIRO
    SimpleRouter::get(URL_BASE . 'visualizar_registro', 'SiteRotas@visualizarRegistro');
    SimpleRouter::get(URL_BASE . 'triagem', 'SiteRotas@triagem');



    SimpleRouter::get(URL_BASE, 'SiteRotas@home');

    SimpleRouter::get(URL_BASE . '404', 'SiteRotas@notFound');



    SimpleRouter::get(URL_BASE . 'consulta', 'SiteRotas@consulta');

    SimpleRouter::get(URL_BASE . 'dados_paciente', 'SiteRotas@dadosPaciente');

    SimpleRouter::get(URL_BASE . 'login', 'SiteRotas@login');

    SimpleRouter::get(URL_BASE . 'visualizar', 'SiteRotas@visualizar');

    SimpleRouter::get(URL_BASE . 'cadastro_funcionario', 'SiteRotas@cadastrarFuncionario');


    SimpleRouter::start();
} catch (\Pecee\SimpleRouter\Exceptions\NotFoundHttpException $th) {

    if (Helpers::getServer() == URL_DESENVOLVIMENTO) {
        echo (new Mensagem())->msg($th->getMessage())->erro()->renderizar();
    } else {
        header("Location:404");
    }
}