function playNotif(message){
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
            duration: 5000
        })
}
document.getElementById('save').addEventListener('click', function () {
    const button = this;
    const text = button.querySelector('.button-text');
    const spinner = button.querySelector('.spinner-border');
    const form = document.getElementById('user-edit');

    const name = document.getElementById('name').value;
    const surname = document.getElementById('secondName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (name == '' || surname == ''){
        message = 'Preencha corretamente o nome e sobrenome';
        playNotif(message);
    }else if(email == ''){
        message = 'Preencha o campo de e-mail';
        playNotif(message);
    }else if(password.length > 0 && password.length < 5){
        console.log(password.length);
        message = 'A nova senha deve conter pelo menos 5 caracteres';
        playNotif(message);
    }else{
        text.classList.add('d-none');
        spinner.classList.remove('d-none');
        form.submit();
    }
});
