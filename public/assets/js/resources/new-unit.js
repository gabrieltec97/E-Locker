document.getElementById('registerUnit').addEventListener('click', function (){
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

const field = document.getElementById('block');
field.addEventListener('keyup', function (event) {
    const rawValue = parseInt(document.getElementById('block').value);
    const checkValue = /[^0-9]/.test(rawValue);
    const blockInfo = document.getElementById('block-info');
    const blockText = document.getElementById('block-text');

    blockInfo.classList.add('d-none');

    if (checkValue == true) {
        blockText.classList.remove('d-none');

    } else {
        blockText.classList.add('d-none');
    }
});
document.getElementById('registerBlock').addEventListener('click', function (){
    const rawValue = parseInt(document.getElementById('block').value);
    const checkValue = /^\d+$/.test(rawValue);
    const text = document.getElementById('registerBlock').querySelector('.button-text');
    const spinner = document.getElementById('registerBlock').querySelector('.spinner-border');

    if (field.value == ''){
       blockInfo.classList.remove('d-none');
    }else if(checkValue != true){
        blockText.classList.remove('d-none');
    }else{
        text.classList.add('d-none');
        spinner.classList.remove('d-none');
       document.getElementById('new-block-form').submit();
    }
});



