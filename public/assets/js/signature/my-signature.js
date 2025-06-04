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

    // Submissão via botão customizado
    document.getElementById('register').addEventListener('click', function () {
        const button = this;
        const text = button.querySelector('.button-text');
        const spinner = button.querySelector('.spinner-border');

        text.classList.add('d-none');
        spinner.classList.remove('d-none');

        // Dispara o evento 'submit' para que o input oculto seja preenchido
        form.dispatchEvent(new Event('submit', { cancelable: true }));

        // Aguarde pequeno delay para garantir preenchimento do input
        setTimeout(() => form.submit(), 100);
    });
});
