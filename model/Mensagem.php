<?php
// CLASSE DE MENSAGENS PERSONALIZADAS COM BOOTSTRAP
namespace sistema;


class Mensagem
{
    private $texto;
    private $css;

    public function __toString()
    {
        return $this->renderizar();
    }

    public function msg($msg): Mensagem
    {
        $this->setTexto($this->filtrar($msg));
        return $this;
    }

    public function erro(): Mensagem
    {
        $this->setCss('alert alert-danger');
        return $this;
    }
    public function informacao(): Mensagem
    {
        $this->setCss('alert alert-primary');
        return $this;
    }

    public function alerta(): Mensagem
    {
        $this->setCss('alert alert-warning');
        return $this;
    }
    public function sucesso(): Mensagem
    {
        $this->setCss('alert alert-success');
        return $this;
    }

    public function renderizar(): string
    {
        return "<div class='" . $this->getCss() . "'>" . $this->getTexto() . "</div>";
    }


    private function filtrar(string $mensagem): string
    {
        return filter_var(strip_tags($mensagem), FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getTexto(): string
    {
        return $this->texto;
    }
    public function setTexto($texto): void
    {
        $this->texto = $texto;
    }
    public function getCss(): string
    {
        return $this->css;
    }
    public function setCss(string $css): void
    {
        $this->css = $css;
    }
}