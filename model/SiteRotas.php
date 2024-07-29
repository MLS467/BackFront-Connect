<?php

namespace sistema\rotas;

use sistema\controlador\Controlador;


class SiteRotas extends Controlador
{
    public function __construct()
    {
        parent::__construct('view/html');
    }

    public function home(): void
    {
        echo $this->template->renderizar('home.html', ['css' => '../css/home.css']);
    }
    public function index(): void
    {
        echo $this->template->renderizar('triagemView.html', ['teste' => 'Maisson']);
    }

    public function cadastrarPaciente(): void
    {
        echo $this->template->renderizar('cadastrarPacienteView.html', ['teste' => 'teste']);
    }

    public function cadastrarFuncionario(): void
    {
        echo $this->template->renderizar('cadastrarFuncionarioView.html', ['teste' => 'teste']);
    }
}