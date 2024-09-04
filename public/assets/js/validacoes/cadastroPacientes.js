import ValidaCampo from "./ValidaCamposFront.js";

document.getElementById('enviado').addEventListener('click', (evt) => {
    const nome = document.querySelector("#nomeCompleto");
    const nomeErro = document.querySelector("#nomeErro");
    const telefone = document.querySelector("#telefone");
    const email = document.querySelector("#email");
    const emailErro = document.querySelector("#emailErro");
    const telefoneErro = document.querySelector("#telErro");
    const cpf = document.getElementById('cpf');
    const cpfErro = document.getElementById('cpfErro');
    const contatoEmergencia = document.getElementById('contatoEmergencia');
    const contatoEmergenciaErro = document.getElementById('ContEmerErro');
    let hasError = false;

    // Verificação dos valores capturados
    console.log("Nome:", nome.value);
    console.log("Telefone:", telefone.value);

    // Valida o campo Nome
    const nomeValidacao = ValidaCampo.validaNome(nome.value);
    if (nomeValidacao !== true) {
        evt.preventDefault();
        nomeErro.innerHTML = nomeValidacao;
        nome.focus();
        hasError = true;
    } else {
        nomeErro.innerHTML = ''; // Limpa erro caso o campo seja válido
    }

    // Valida o email
    const emailValidacao = ValidaCampo.validaEmail(email.value);
    if (emailValidacao !== true) {
        evt.preventDefault();
        emailErro.innerHTML = emailValidacao;
        email.focus();
        hasError = true;
    } else {
        emailErro.innerHTML = ''; // Limpa erro caso o campo seja válido
    }

    // Valida o campo Telefone
    const telefoneValidacao = ValidaCampo.validaTelefone(telefone.value);
    if (telefoneValidacao !== true) {
        evt.preventDefault();
        telefoneErro.innerHTML = telefoneValidacao;
        if (!hasError) telefone.focus(); // Foca no telefone se for o primeiro erro
        hasError = true;
    } else {
        telefoneErro.innerHTML = ''; // Limpa erro caso o campo seja válido
    }

    // Valida o campo Contato de Emergência
    const contatoEmergenciaValidacao = ValidaCampo.validaTelefone(contatoEmergencia.value);
    if (contatoEmergenciaValidacao !== true) {
        evt.preventDefault();
        contatoEmergenciaErro.innerHTML = contatoEmergenciaValidacao;
        if (!hasError) contatoEmergencia.focus(); // Foca no Contato de Emergência se for o primeiro erro
        hasError = true;
    } else {
        contatoEmergenciaErro.innerHTML = ''; // Limpa erro caso o campo seja válido
    }

    // Valida o campo CPF
    const cpfValidacao = ValidaCampo.validaCPF(cpf.value);
    console.log(cpfValidacao);
    if (cpfValidacao !== true) {
        evt.preventDefault();
        cpfErro.innerHTML = cpfValidacao;
        if (!hasError) cpf.focus(); // Foca no CPF se for o primeiro erro
        hasError = true;
    } else {
        cpfErro.innerHTML = ''; // Limpa erro caso o campo seja válido
    }
});
