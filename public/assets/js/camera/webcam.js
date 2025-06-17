document.addEventListener('DOMContentLoaded', () => {
    const webcam = document.getElementById('webcam');
    const captureButton = document.getElementById('capture');
    const startButton = document.getElementById('start-camera');
    const retakeButton = document.getElementById('retake');
    const photoInput = document.getElementById('photo');
    const previewContainer = document.getElementById('preview-container');
    const preview = document.getElementById('preview');

    let stream = null;
    let canvas = document.createElement('canvas'); // Criar dinamicamente

    startButton.addEventListener('click', async () => {
    // Detecta se é um dispositivo móvel
    const isMobile = /Mobi|Android/i.test(navigator.userAgent);
    
    // Se for móvel, tentamos a câmera traseira (facingMode: environment)
    const constraints = isMobile ? {
        video: {
            facingMode: { exact: 'environment' } // Câmera traseira
        }
    } : {
        video: true // No desktop, apenas tenta a câmera disponível
    };

    try {
        stream = await navigator.mediaDevices.getUserMedia(constraints);
        webcam.srcObject = stream;
        webcam.classList.remove('hidden');
        startButton.classList.add('hidden');
        captureButton.classList.remove('hidden');
    } catch (err) {
        console.error("Erro ao acessar a câmera: ", err);
        alert("Não foi possível acessar a câmera.");
    }
});


    captureButton.addEventListener('click', () => {
        canvas.width = webcam.videoWidth;
        canvas.height = webcam.videoHeight;
        canvas.getContext('2d').drawImage(webcam, 0, 0, canvas.width, canvas.height);

        const imageData = canvas.toDataURL('image/png');
        photoInput.value = imageData;
        preview.src = imageData;

        // Parar a câmera
        stream.getTracks().forEach(track => track.stop());

        // Esconder vídeo, mostrar preview
        webcam.style.display = 'none';
        startButton.style.display = 'none';
        captureButton.classList.add('hidden');
        retakeButton.classList.remove('hidden');
        previewContainer.classList.remove('hidden');
    });

    retakeButton.addEventListener('click', async () => {
    photoInput.value = '';
    preview.src = '';
    previewContainer.classList.add('hidden');
    retakeButton.classList.add('hidden');
    startButton.classList.remove('hidden');

    // Detecta se é um dispositivo móvel
    const isMobile = /Mobi|Android/i.test(navigator.userAgent);
    
    // Se for móvel, tentamos a câmera traseira (facingMode: environment)
    const constraints = isMobile ? {
        video: {
            facingMode: { exact: 'environment' } // Câmera traseira
        }
    } : {
        video: true // No desktop, apenas tenta a câmera disponível
    };

    try {
        // Reativando a câmera com as mesmas restrições
        stream = await navigator.mediaDevices.getUserMedia(constraints);
        webcam.srcObject = stream;
        webcam.classList.remove('hidden');
        webcam.style.display = 'block';
        startButton.classList.add('hidden');
        captureButton.classList.remove('hidden');
    } catch (err) {
        console.error("Erro ao acessar a câmera: ", err);
        alert("Não foi possível acessar a câmera.");
    }
});

});
