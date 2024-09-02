import ValidaCampos from './ValidaCamposFront.js';

document.getElementById('enviarFunc').addEventListener('click', (evt) => {
    evt.preventDefault();
    const cargo = document.getElementById('cargoForm').value;
    const cargoForm = document.getElementById('cargoForm');
    const nomeFunc = document.getElementById('nomeCompleto');
    const nomeErroFunc = document.getElementById('nomeErroFunc');
    const telefone = document.getElementById('telefone');
    const telefoneErroFunc = document.getElementById('telefoneFunc');
    const emailFunc = document.getElementById('email')
    const emailFuncErro = document.getElementById('emailFuncErro')
    const cpfFunc = document.getElementById('cpf')
    const cpfFuncErro = document.getElementById('cpfFuncErro')
    const form = document.querySelector('form');
    let hasError = false;

    console.log(cargo);
    const nomeValidacao = ValidaCampos.validaNome(nomeFunc.value);
    if (nomeValidacao !== true) {
        evt.preventDefault();
        nomeErroFunc.innerHTML = nomeValidacao;
        nomeFunc.focus();
        hasError = true;
    } else {
        nomeErroFunc.innerHTML = ''; // Limpa erro caso o campo seja válido
    }

    const telefoneValidacao = ValidaCampos.validaTelefone(telefone.value);
    if (telefoneValidacao !== true) {
        evt.preventDefault();
        telefoneErroFunc.innerHTML = telefoneValidacao;
        telefone.focus();
        hasError = true;
    } else {
        telefoneErroFunc.innerHTML = ''; // Limpa erro caso o campo seja válido
    }

    const cpfValidacao = ValidaCampos.validaCPF(cpfFunc.value);
    if (cpfValidacao !== true) {
        evt.preventDefault();
        cpfFuncErro.innerHTML = cpfValidacao;
        cpfFunc.focus();
        hasError = true;
    } else {
        cpfFuncErro.innerHTML = ''; // Limpa erro caso o campo seja válido
    }

    // Valida o campo Email
    const emailValidacao = ValidaCampos.validaEmail(emailFunc.value);
    if (emailValidacao !== true) {
        evt.preventDefault();
        emailFuncErro.innerHTML = emailValidacao;
        emailFunc.focus();
        hasError = true;
    } else {
        emailFuncErro.innerHTML = ''; // Limpa erro caso o campo seja válido
    }

    const isCargoValido = validarCargo();

    if (!isCargoValido) {
        evt.preventDefault();
        hasError = true;
        cargoForm.innerHTML = 'Selecione um cargo!';
    } else {
        cargoForm.innerHTML = '';
    }

    if (!hasError)
        form.submit();

});


function validarCargo() {
    const cargo = document.getElementById('cargo').value;

    const opcoesValidas = ['medico', 'enfermeiro', 'atendente'];

    return opcoesValidas.includes(cargo);
}