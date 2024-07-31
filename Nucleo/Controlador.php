<?php

namespace sistema\controlador;

use sistema\suporte\Template;

class Controlador
{
    protected Template $template;

    public function __construct(string $diretorio)
    {
        $this->template = new Template($diretorio);
    }
}