document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('signature-pad');

    if (!canvas) {
        console.warn('Canvas não encontrado');
        return;
    }

    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255,255,255)',
    });

    const clearButton = document.getElementById('clear-signature');
    const signatureInput = document.getElementById('signature');
    const form = document.getElementById('upd-packet');

    clearButton.addEventListener('click', () => {
        signaturePad.clear();
        signatureInput.value = '';
    });

    form.addEventListener('submit', () => {
        if (!signaturePad.isEmpty()) {
            signatureInput.value = signaturePad.toDataURL('image/png');
        } else {
            signatureInput.value = '';
        }
    });

    function showToast(message){
        const notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            }
        });

        notyf
            .error({
                message: message,
                dismissible: true,
                duration: 7000
            })
    }

    // Submissão via botão customizado
    document.getElementById('register').addEventListener('click', function () {
        const button = this;
        const text = button.querySelector('.button-text');
        const spinner = button.querySelector('.spinner-border');

        const status = document.getElementById('status');
        const recipient = document.getElementById('recipient').value;

        if (status.value == 'Aguardando Retirada' &&  recipient != ''){
            const message = 'Preencha corretamente campo de status';
            showToast(message);
            return;
        }else if(status.value != 'Aguardando Retirada' && status.value != 'Cancelado'){
            if (recipient == ''){
                const message = 'Preencha o nome do responsável pela retirada.';
                showToast(message);
                return;
            }
        }

        if(status.value == 'Retirado por terceiros' || status.value == 'Retirado pelo destinatário'){

        }

        text.classList.add('d-none');
        spinner.classList.remove('d-none');

        // Dispara o evento 'submit' para que o input oculto seja preenchido
        form.dispatchEvent(new Event('submit', { cancelable: true }));

        // Aguarde pequeno delay para garantir preenchimento do input
        setTimeout(() => form.submit(), 100);
    });

    const status = document.getElementById('status');

    status.addEventListener('change', function(){
        const owner = document.getElementById('owner').value;

        if (status.value == 'Retirado pelo destinatário') {
            document.getElementById('recipient').value = owner;
        }else if(status.value == 'Retirado por terceiros'){
            document.getElementById('recipient').value = '';
            document.getElementById('recipient').focus();
        }
        else{
            document.getElementById('recipient').value = '';
        }    
    });
});
