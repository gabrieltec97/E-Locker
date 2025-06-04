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
        stream = await navigator.mediaDevices.getUserMedia({ video: true });
        webcam.srcObject = stream;
        webcam.classList.remove('hidden');
        startButton.classList.add('hidden');
        captureButton.classList.remove('hidden');
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

        //Reativando a câmera.
        stream = await navigator.mediaDevices.getUserMedia({ video: true });
        webcam.srcObject = stream;
        webcam.classList.remove('hidden');
        webcam.style.display = 'block';
        startButton.classList.add('hidden');
        captureButton.classList.remove('hidden');
    });
});
