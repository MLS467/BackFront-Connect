import ValidaCampo from "./ValidaCamposFront.js";
const nome = document.querySelector("#nomeDadosBasicos");
const nomeErro = document.querySelector("#nomeDb");
const tel = document.querySelector("#contato_emergencia");
const telErro = document.querySelector("#telDb");
const cpf = document.getElementById('cpf');
const cpfDb = document.getElementById('cpfDb');

document.getElementById('enviado').addEventListener('click', (evt) => {

    if (!ValidaCampo.validaNome(nome.value)) {
        nomeErro.innerHTML = ValidaCampo.mensagens.nome;
    }

    if (!ValidaCampo.validaTelefone(tel.value)) {
        telErro.innerHTML = ValidaCampo.mensagens.telefone;
    }

    if (!ValidaCampo.validaCPF(cpf.value)) {
        cpfDb.innerHTML = ValidaCampo.mensagens.cpf;
    }
})