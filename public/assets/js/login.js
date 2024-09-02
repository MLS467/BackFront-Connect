import ValidaCampo from "./validacoes/ValidaCamposFront.js";
import { Caixa } from "./caixaMsg.js";

const btnLogin = document.querySelector('#btnLogin');

btnLogin.addEventListener('click', (evt) => {
    const emailDados = document.getElementById('email').value;
    const senhaDados = document.getElementById('senha').value;

    // Validação do email e da senha
    const emailErro = ValidaCampo.validaEmail(emailDados);
    const senhaErro = ValidaCampo.validaSenha(senhaDados);

    if (emailErro === true && senhaErro === true) {
        // Se ambos os campos forem válidos, dispara o clique do botão oculto
        document.getElementById('btnOculto').click();
    } else {
        // Verifica se o cargo foi selecionado
        const cargo = document.querySelector("#cargo").value;
        if (cargo == '0') {
            const config = {
                cor: "rgba(110, 197, 207, 0.7)",
                destino: document.body
            }
            Caixa.config(config);
            Caixa.mostrar("Preencha os Campos", "Selecione um Cargo!");
        }

        // Mostra a mensagem de erro correspondente
        const err = document.getElementById('err');
        const msg = emailErro !== true ? emailErro : senhaErro !== true ? senhaErro : 'Erro desconhecido';
        err.innerHTML = `<div class='text-center alert alert-danger'>${msg}</div>`;
        err.style.color = 'red';

        // Limpa a mensagem de erro após 5 segundos
        setTimeout(() => {
            err.innerHTML = "";
        }, 5000);
    }


})