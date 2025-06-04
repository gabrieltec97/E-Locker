document.addEventListener('DOMContentLoaded', () => {
    const webcam = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture');
    const startButton = document.getElementById('start-camera');
    const retakeButton = document.getElementById('retake');
    const photoInput = document.getElementById('photo');
    const previewContainer = document.getElementById('preview-container');
    const preview = document.getElementById('preview');

    let stream = null;

    startButton.addEventListener('click', async () => {
        stream = await navigator.mediaDevices.getUserMedia({ video: true });
        webcam.srcObject = stream;
        webcam.classList.remove('hidden');
        startButton.classList.add('hidden');
        captureButton.classList.remove('hidden');
    });

    captureButton.addEventListener('click', () => {
        const context = canvas.getContext('2d');
        canvas.width = webcam.videoWidth;
        canvas.height = webcam.videoHeight;
        context.drawImage(webcam, 0, 0, canvas.width, canvas.height);

        // Gera imagem
        const imageData = canvas.toDataURL('image/png');
        photoInput.value = imageData;
        preview.src = imageData;

        // Esconde tudo menos o preview
        webcam.classList.add('hidden');
        canvas.classList.add('hidden'); // canvas não aparece
        captureButton.classList.add('hidden');
        retakeButton.classList.remove('hidden');
        previewContainer.classList.remove('hidden');
    });

    retakeButton.addEventListener('click', () => {
        webcam.classList.remove('hidden');
        captureButton.classList.remove('hidden');
        retakeButton.classList.add('hidden');
        previewContainer.classList.add('hidden');
        photoInput.value = '';
        preview.src = '';
    });
});
