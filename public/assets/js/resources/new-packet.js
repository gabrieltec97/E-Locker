document.getElementById('register').addEventListener('click', function () {
    const button = this;
    const text = button.querySelector('.button-text');
    const spinner = button.querySelector('.spinner-border');
    const form = document.getElementById('new-packet');
    const receiver = document.getElementById('receiver').value;
    const recipient = document.getElementById('recipient').value;
    const unit = document.getElementById('unit').value;

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


    if (receiver == ''){
        const message = 'Preencha corretamente o nome do recebedor';
        showToast(message);
    }else if(recipient == ''){
        const message = 'Preencha corretamente o nome do destinatário';
        showToast(message);
    }else if(unit == 'selecione'){
        const message = 'Selecione a unidade do destinatário';
        showToast(message);
    }else{
        text.classList.add('d-none');
        spinner.classList.remove('d-none');
        form.submit();
    }
});
