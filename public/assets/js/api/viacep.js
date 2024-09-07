const cep = document.getElementById('cepCadastraPac');

const getCep = async (cep) => {
    (await fetch(`https://viacep.com.br/ws/${cep}/json/`)).json()
        .then(res => {
            console.log(res)
            try {
                document.getElementById('bairro').value = res.bairro;
                document.getElementById('rua').value = res.logradouro;
                document.getElementById('cidade').value = res.localidade;
            } catch (e) {
                document.getElementById('bairroFunc').value = res.bairro;
                document.getElementById('cidadeFunc').value = res.localidade;
                document.getElementById('ruaFunc').value = res.logradouro;

            }
        });
}

cep.addEventListener('focusout', () => {
    getCep(cep.value);
})


