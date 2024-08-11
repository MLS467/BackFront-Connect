//fazer a classe para montar conforme o form
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formEv');
    // form.insertAdjacentElement('beforeend', message); // Insere a mensagem antes do botão de envio
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        // Exibe a mensagem
        // message.textContent = 'Formulário enviado com sucesso!';


        alert('Testando!');

        // Define um atraso antes de enviar o formulário
        setTimeout(function () {
            form.submit(); // Envia o formulário após o atraso
        }, 2000); // 2000 milissegundos = 2 segundos
    });
});

