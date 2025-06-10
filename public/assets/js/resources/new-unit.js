['registerUnit', 'registerBlock'].forEach(function (id) {
    document.getElementById(id).addEventListener('click', function () {
        const button = this;
        const text = button.querySelector('.button-text');
        const spinner = button.querySelector('.spinner-border');
        const form = document.getElementById('new-unit-form');

        const unitNumber = document.getElementById('unit-number').value;
        const unitNumberField = document.getElementById('unit-number');
        const unitNumberInfo = document.getElementById('unit-number-info');
        const unit = document.getElementById('unit').value;
        const unitField = document.getElementById('unit');
        const unitInfo = document.getElementById('block-info');

        if(unitNumber == ''){
            unitNumberInfo.classList.remove('d-none');
            unitNumberField.addEventListener('click',  () =>{
                setTimeout(() => {
                    unitNumberInfo.classList.add('fade-out');
                }, 1000);
            });
        }else if (unit == 'selecione'){
            unitInfo.classList.remove('d-none');

            unitField.addEventListener('click',  () =>{
                unitInfo.classList.add('fade-out');
            });
        }else{
            text.classList.add('d-none');
            spinner.classList.remove('d-none');
            form.submit();
        }
    });
});
