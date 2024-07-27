<?php

namespace sistema\rotas;

use sistema\controlador\Controlador;


class SiteRotas extends Controlador
{
    public function __construct()
    {
        parent::__construct('view/html');
    }

    public function index(): void
    {
        echo $this->template->renderizar('triagemView.html', ['teste' => 'teste']);
    }

    public function cadastrarPaciente(): void
    {
        echo $this->template->renderizar('cadastrarPacienteView.html', ['teste' => 'teste']);
    }
}