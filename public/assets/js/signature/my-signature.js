document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('signature-pad');

    if (!canvas) {
        console.warn('Canvas de assinatura não encontrado!');
        return;
    }

    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255,255,255)',
    });

    const clearButton = document.getElementById('clear-signature');
    const signatureInput = document.getElementById('signature');

    clearButton.addEventListener('click', () => {
        signaturePad.clear();
        signatureInput.value = '';
    });

    const form = document.getElementById('upd-packet');
    if (form) {
        form.addEventListener('submit', () => {
            if (!signaturePad.isEmpty()) {
                signatureInput.value = signaturePad.toDataURL('image/png');
            }
        });
    }
});
