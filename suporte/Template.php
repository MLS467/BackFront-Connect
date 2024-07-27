<?php

namespace sistema\suporte;


class Template
{
    private \Twig\Environment $twig;


    // CARREGA O ARQUIVO 
    public function __construct(string $diretorio)
    {
        $loader = new \Twig\Loader\FilesystemLoader($diretorio);
        $this->twig = new \Twig\Environment($loader);
    }


    //RETORNA O RENDER DO TWIG TEMPLATE
    public function renderizar(string $view, array $dados)
    {
        return $this->twig->render($view, $dados);
    }
}