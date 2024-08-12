document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formEv'); // Formulário a ser enviado
    const popupContainer = document.getElementById('popupContainer'); // Container do pop-up

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Impede o envio imediato do formulário

        // Verifica se o pop-up já está no DOM
        if (!document.getElementById('confirmationPopup')) {
            // Cria o elemento div para o pop-up
            const popupDiv = document.createElement('div');
            popupDiv.id = 'confirmationPopup';
            popupDiv.className = 'popup';

            // Adiciona o HTML do pop-up à div
            popupDiv.innerHTML = `
                <div class="popup-content">
                    <div>
                        <img src="public/assets/img/check.gif" alt="check" style="width:200px;height:200px;">
                    </div>
                    <p>Formulário enviado com sucesso!</p>
                </div>
            `;

            // Verifica se popupContainer existe
            if (popupContainer) {
                // Adiciona o pop-up ao início do container
                popupContainer.prepend(popupDiv);
            } else {
                console.error('Container do pop-up não encontrado.');
            }
        }

        // Mostra o pop-up
        const confirmationPopup = document.getElementById('confirmationPopup');
        if (confirmationPopup) {
            confirmationPopup.classList.remove('hidden');

            // Fecha o pop-up após 3 segundos e envia o formulário
            setTimeout(() => {
                confirmationPopup.classList.add('hidden');
                form.submit();
            }, 3000);
        } else {
            console.error('Pop-up de confirmação não encontrado.');
        }
    });
});
