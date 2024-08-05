class ValidaCampo {

    email;
    senha;

    constructor(dados) {
        this.email = dados.email;
        this.senha = dados.senha;
    }

    validaCamposLogin = () => {
        console.log(this.email, this.senha);
        // Verifica se o e-mail está vazio ou não corresponde ao padrão
        if (!this.email || !this.email.match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$/)) {
            return false;
        }

        // Verifica se a senha está vazia ou tem menos de 6 caracteres
        if (!this.senha || this.senha.length < 6) {
            return false;
        }

        return true;
    }

}


const btnLogin = document.querySelector('#btnLogin');

btnLogin.addEventListener('click', (evt) => {
    const emailDados = document.getElementById('email').value;
    const senhaDados = document.getElementById('senha').value;

    const $dados = {
        email: emailDados,
        senha: senhaDados
    }

    const val = new ValidaCampo($dados);

    if (val.validaCamposLogin()) {
        document.getElementById('btnOculto').click();
    } else {
        const err = document.getElementById('err');
        err.innerHTML = "<div class='text-center alert alert-danger'>Email ou Senha inválido!</div>";
        err.style.color = 'red';
        setTimeout(() => {
            err.innerHTML = "";
        }, 5000);
    }

})