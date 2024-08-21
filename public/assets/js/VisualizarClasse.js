class Popup {

    destino = document.body;


    criarTela = () => {
        const telaEscura = document.createElement('div');
        telaEscura.setAttribute('id', 'CorpoTelaEscura');
        this.destino.prepend(telaEscura);
        telaEscura.innerHTML =
            `
   
        `
    }




}

export { Popup };