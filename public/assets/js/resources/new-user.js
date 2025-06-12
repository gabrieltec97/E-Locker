document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.querySelector('input[name="email"]');
    const getButton = document.getElementById('register');
    const avisoEmail = emailInput.nextElementSibling; // Pega o elemento irmão, no caso o span.
    avisoEmail.style.display = 'none'; // começa escondido

    emailInput.addEventListener('input', function () { //Pegando o valor para cada vez que a tecla for pressionada.
        const email = emailInput.value.trim();
        if (email.length === 0) {
            avisoEmail.style.display = 'none';
            return;
        }

        fetch(`/verificar-email?email=${encodeURIComponent(email)}`)
            .then(res => res.json())
            .then(data => {
                if (data.exists) {
                    avisoEmail.style.display = 'block';
                    getButton.disabled = true;
                } else {
                    avisoEmail.style.display = 'none';
                    getButton.disabled = false;
                }
            })
            .catch(err => {
                console.error('Erro ao verificar email:', err);
                avisoEmail.style.display = 'none';
                getButton.disabled = false;
            });
    });

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

    document.getElementById('register').addEventListener('click', function () {
        const button = this;
        const text = button.querySelector('.button-text');
        const spinner = button.querySelector('.spinner-border');
        const form = document.getElementById('user-form');

        const name = document.getElementById('name').value;
        const surname = document.getElementById('secondName').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const profile = document.getElementById('profile').value;

        if (name == '' || surname == ''){
            message = 'Preencha corretamente o nome e sobrenome';
            playNotif(message);
        }else if(email == ''){
            message = 'Preencha o campo de e-mail';
            playNotif(message);
        }else if(password == ''){
            message = 'Preencha o campo de senha';
            playNotif(message);
        }else if(password.length < 5){
            message = 'A senha deve conter pelo menos 5 caracteres';
            playNotif(message);
        }else if(profile == 'selecione'){
            message = 'Escolha um perfil para este usuário';
            playNotif(message);
        }else{
            text.classList.add('d-none');
            spinner.classList.remove('d-none');
            form.submit();
        }
    });
});
