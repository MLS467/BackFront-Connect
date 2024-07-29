<?php

namespace sistema\suporte;

use sistema\Mensagem;
use Twig\Lexer;

class Template
{
    private \Twig\Environment $twig;


    public function __construct(string $diretorio)
    {
        // CARREGA O DIRETORIO DAS VIEWS
        $loader = new \Twig\Loader\FilesystemLoader($diretorio);
        $this->twig = new \Twig\Environment($loader);

        // CONFIGURAÇÃO PARA USAR FUNÇÕES NA CAMADA DE VIEW
        $lexer = new Lexer($this->twig, array($this->helper()));
        $this->twig->setLexer($lexer);
    }


    //RETORNA O RENDER DO TWIG TEMPLATE
    public function renderizar(string $view, array $dados)
    {
        return $this->twig->render($view, $dados);
    }


    // FUNÇÕES PARA USAR NO TWIG TEMPLATE
    public function helper(): void
    {
        array(
            // FUNÇÃO PARA RETORNAR ERRO (MENSSAGEM)
            $this->twig->addFunction(
                new \Twig\TwigFunction('sucesso', function (string $msg) {
                    echo (new Mensagem())->msg($msg)->sucesso();
                })
            )


        );
    }
}