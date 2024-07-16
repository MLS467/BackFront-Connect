<?php
require_once "DB.php";
require_once "config.php";

class Login
{
    private ?string $nome = null;

    public function __construct(
        private string $email,
        private string $senha,
        private string $token,
        private string $nomeTabela = 'usuarios'
    ) {
    }


    public function isAutenticar(): bool
    {
        $sql = "SELECT * FROM $this->nomeTabela WHERE email = ? AND senha=?";
        $sql = DB::preparar($sql);
        $sql->execute(array($this->email, $this->senha));
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            $idUsuario = $usuario['id'];
            // FAZER A ATUALIZAÇÃO DO TOKEN
            $atualizar = "UPDATE $this->nomeTabela SET token = ? WHERE id = ?";
            $atualizar = DB::preparar($atualizar);
            $atualizar->execute(array($this->token, $idUsuario));
            return true;
        }

        return false;
    }


    public function isAutenticado(string $token)
    {
        $sql = "SELECT * FROM $this->nomeTabela WHERE token = ? ";
        $sql = DB::preparar($sql);
        $sql->execute(array($token));
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if ($this->isValidaToken($usuario['token'])) {
                $this->setNome($usuario["nome"]);
                $this->setEmail($usuario["email"]);
                return $usuario['token'];
            }
        }

        return false;
    }


    public function isValidaToken(string $token): bool
    {
        if ($token == $_SESSION['Token']) {
            return true;
        }

        return false;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function getNomeTabela(): string
    {
        return $this->nomeTabela;
    }

    public function setNomeTabela(string $nomeTabela)
    {
        $this->nomeTabela = $nomeTabela;
    }
}