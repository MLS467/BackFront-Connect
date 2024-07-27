<?php
require_once "vendor/autoload.php";


use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace('sistema\rotas');


SimpleRouter::get(URL_BASE, 'SiteRotas@index');

SimpleRouter::get(URL_BASE . 'cadastro', 'SiteRotas@cadastrarPaciente');


SimpleRouter::start();