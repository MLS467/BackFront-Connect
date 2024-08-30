import { Popup } from "./VisualizarClasse.js";

const btn = [...document.querySelectorAll('.Visualizar')];
// const btn = document.getElementById('btn');
btn.map((elemento) => {
    elemento.addEventListener('click', (evt) => {
        const id = parseInt(evt.target.parentNode.parentNode.firstChild.textContent);
        console.log(evt.target.parentNode.parentNode.firstChild.textContent);
        const teste = new Popup();
        teste.criarTela();
        teste.enviaId(id);

    })
});



