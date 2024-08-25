
[...document.querySelectorAll('.VerPac')].forEach(element => {
    element.addEventListener('click', async (evt) => {
        const id = evt.target.parentNode.parentNode.firstChild.textContent;
        const endpoint = `/PROJETO_INTEGRADO_FRONT_E_BACK/Nucleo/retornaPacienteTriagem.php?id=${id}`;
        const pegaId = (await fetch(endpoint, { method: "GET" })).json()
            .then(res => {
                if (!res.status) {
                    alert("Não encontrado!");
                } else {
                    document.location.href = "/PROJETO_INTEGRADO_FRONT_E_BACK/triagem";
                }
            });
    })
});

