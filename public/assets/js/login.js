import ValidaCampo from "./validacoes/ValidaCamposFront.js";
import { Caixa } from "./caixaMsg.js";




const btnLogin = document.querySelector('#btnLogin');

btnLogin.addEventListener('click', (evt) => {
    const emailDados = document.getElementById('email').value;
    const senhaDados = document.getElementById('senha').value;

    const $dados = {
        email: emailDados,
        senha: senhaDados
    }


    ValidaCampo.definirDados($dados);

    if (ValidaCampo.validaEmail() && ValidaCampo.validaSenha()) {
        document.getElementById('btnOculto').click();
    } else {
        const cargo = document.querySelector("#cargo").value;
        if (cargo == '0') {
            const config = { // CONFIG QUE VAI COMO PARAMETRO PARA A MÉTODO DE CONFIGURAÇÃO
                cor: "rgba(110, 197, 207, 0.7)",
                destino: document.body
            }
            Caixa.config(config);
            Caixa.mostrar("Preencha os Campos", "Selecione um Cargo!");
        }
        const err = document.getElementById('err');

        const msg = ValidaCampo.mensagens.email ? ValidaCampo.mensagens.email : ValidaCampo.mensagens.senha;
        err.innerHTML = `<div class='text-center alert alert-danger'>${msg}</div>`;
        err.style.color = 'red';
        setTimeout(() => {
            err.innerHTML = "";
        }, 5000);
    }

})