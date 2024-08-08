class Caixa {

    static cor = "#ccc";
    static destino = null;
    static divmsg = null;
    static alturaTotal = null;
    status = null;

    // FIZ O CONSTRUTOR QUE VAI RECEBER UM OBJ LITERAL
    static config = (config) => {
        this.cor = config.cor;
        this.destino = config.destino;
    }

    static mostrar = ($titulo, $texto) => {
        // MOSTRA A CAIXA NO BODY

        //TEXTOS DA CAIXA
        // this.destino = document.body;
        this.titulo = $titulo;
        this.texto = $texto;

        // ESTILIZAÇÃO DA CAIXA
        let estilo = `display: flex;
        z-index: 999;
        position: absolute;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        top: 0;
        left: 0;
        width: 100%;
        height:100vh;
        background-color: rgba(0, 0, 0, 0.75);
        `;


        const estiloAreaCaixa =
            `display:flex;
        justify-content:flex-start;
        align-items:center;
        flex-direction:column;
        width:500px;
        height:200px;
        background:#eee;
        border-top-left-radius:5px;
        border-top-right-radius:5px;
        border-bottom-left-radius:5px;
        border-bottom-right-radius:5px;
        z-index:999999999;
        `;

        const estiloTitulo =
            `display:flex;
            background:${this.cor};
            padding:10px;
            color:white;
        justify-content:center;
        align-items:center;
        width:100%;
        height:100px;
        border-top-left-radius:5px;
        border-top-right-radius:5px;
        `;

        const estiloBtn =
            `
        color:black;
        background:${this.cor};
        border:#0091ffc9;
        border-radius:5px;
        width:20%;
        padding:5px;
        cursor:pointer;
        `


        const estiloCentro =
            `display:flex;
            padding:10px;
        justify-content:center;
        align-items:center;
        width:100%;
        height:200px;
        `;

        const estiloFinal = `
            display:flex;
        justify-content:center;
        align-items:center;
        width:100%;
        height:100px;
        background:#ccc;
        border-bottom-left-radius:5px;
        border-bottom-right-radius:5px;
        `

        // CRIA A CAIXA ESCURA NO FUNDO DA JANELA
        this.divmsg = document.createElement('div');
        this.divmsg.setAttribute("id", "divmsg");
        this.divmsg.setAttribute("style", estilo);
        this.destino.prepend(this.divmsg);

        const areaCaixa = document.createElement('div');
        areaCaixa.setAttribute("style", estiloAreaCaixa);
        this.divmsg.appendChild(areaCaixa);

        // CRIA O TITULO DA CAIXA
        const areaTitulo = document.createElement("div");
        areaTitulo.setAttribute("style", estiloTitulo);
        areaTitulo.innerHTML = this.titulo;
        areaCaixa.prepend(areaTitulo);

        // CRIA O CENTRO DA CAIXA
        const areaCentral = document.createElement("div");
        areaCentral.setAttribute("style", estiloCentro);
        areaCentral.innerHTML = this.texto;
        areaCaixa.appendChild(areaCentral);

        // CRIA O RODAPÉ DA CAIXA 
        const areaFinal = document.createElement("div");
        areaFinal.setAttribute("style", estiloFinal);

        // CRIA O BOTÃO DA CAIXA
        const btn = document.createElement("button");
        btn.setAttribute("id", "btnCaixa")
        btn.setAttribute("style", estiloBtn);
        btn.addEventListener("click", () => { this.ocultar() });
        btn.innerHTML = "OK";
        areaFinal.appendChild(btn);
        areaCaixa.appendChild(areaFinal);

        this.status = true;

    }

    static ocultar = () => {
        // OCULTA A CAIXA QUANDO O BOTÃO É PRESSIONADO
        if (this.status) {
            this.status = false;
            this.divmsg.remove();
        }
    }

}

// FAZ A EXPORTAÇÃO DA CLASSE CAIXA
export { Caixa };