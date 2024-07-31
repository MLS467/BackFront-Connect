<?php
require_once "vendor/autoload.php";

use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;
use sistema\nucleo\Helpers;
use sistema\nucleo\Mensagem;


SimpleRouter::setDefaultNamespace('sistema\rotas');

try {
    SimpleRouter::get(URL_BASE, 'SiteRotas@home');

    SimpleRouter::get(URL_BASE . '404', 'SiteRotas@notFound');

    SimpleRouter::get(URL_BASE . 'cadastro_triagem', 'SiteRotas@cadastro_triagem');

    SimpleRouter::get(URL_BASE . 'cadastro_sinais_vitais', 'SiteRotas@cadastro_sv');

    SimpleRouter::get(URL_BASE . 'cadastro_paciente', 'SiteRotas@cadastrarPaciente');

    SimpleRouter::get(URL_BASE . 'cadastro_funcionario', 'SiteRotas@cadastrarFuncionario');

    SimpleRouter::get(URL_BASE . 'visualizar', 'SiteRotas@visualizar');

    SimpleRouter::start();
} catch (\Pecee\SimpleRouter\Exceptions\NotFoundHttpException $th) {

    if (Helpers::getServer() == URL_DESENVOLVIMENTO) {
        echo (new Mensagem())->msg($th->getMessage())->erro()->renderizar();
    } else {
        header("Location:404");
    }
}