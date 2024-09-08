[...document.querySelectorAll('.excluirFunc')].map(e => {
    e.addEventListener('click', (evt) => {
        const id = parseInt(evt.target.parentNode.parentNode.firstChild.nextElementSibling.getAttribute('id'));
        const cargo = evt.target.parentNode.previousElementSibling.textContent;
        requiId(id, cargo);
    });
})

async function requiId(id, cargo) {
    let endpoint = `/PROJETO_INTEGRADO_FRONT_E_BACK/Nucleo/Excluir_Editar_Func.php?E_E_Funcionario=${id}&cargo=${cargo}`;
    const resposta = await fetch(endpoint, { method: 'GET' })

    if (resposta.ok) {
        window.location.reload();
    } else {
        // Se a resposta não for bem-sucedida, exibe um alerta com o erro
        alert('Houve um erro ao processar a requisição. Por favor, tente novamente.');
    }

} 