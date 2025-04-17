(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
})()

function validateDocument(cpf) {
    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

    let sum = 0;
    for (let i = 0; i < 9; i++) {
        sum += parseInt(cpf.charAt(i)) * (10 - i);
    }

    let digit1 = 11 - (sum % 11);
    if (digit1 >= 10) digit1 = 0;

    if (digit1 !== parseInt(cpf.charAt(9))) return false;

    sum = 0;
    for (let i = 0; i < 10; i++) {
        sum += parseInt(cpf.charAt(i)) * (11 - i);
    }

    let digit2 = 11 - (sum % 11);
    if (digit2 >= 10) digit2 = 0;

    return digit2 === parseInt(cpf.charAt(10));
}

function onCpfKeyUp(input) {
    const validCpf = validateDocument(input.value);
    input.style.borderColor = validCpf ? 'green' : 'red';
}

function maskCpf(input) {
    let valor = input.value.replace(/\D/g, '');

    if (valor.length > 11) valor = valor.slice(0, 11);

    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    input.value = valor;
}

function validatePassword(senha) {
    const hasCaracter = senha.length >= 8;
    const upperCase = /[A-Z]/.test(senha);
    const lowerCase = /[a-z]/.test(senha);
    const hasNumber = /\d/.test(senha);
    const hasSimbol = /[!@#$%^&*(),.?":{}|<>]/.test(senha);

    document.getElementById("8caracteres").style.color = hasCaracter ? "green" : "red";
    document.getElementById("maiuscula").style.color = upperCase ? "green" : "red";
    document.getElementById("minusculas").style.color = lowerCase ? "green" : "red";
    document.getElementById("numeros").style.color = hasNumber ? "green" : "red";
    document.getElementById("simbolos").style.color = hasSimbol ? "green" : "red";
}

document.getElementById('modalDeletar').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var dataBsId = button.getAttribute('data-bs-id')
    var form = document.getElementById('deleteForm');
    form.action = '/alunos/' + dataBsId;
})

let lastEditedStudent = null;

document.getElementById('modalAluno').addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const dataBsData = button.getAttribute('data-bs-data');
    const data = dataBsData ? JSON.parse(dataBsData) : null;
    const form = document.getElementById('formAluno');

    const password = document.getElementById('password');

    const isNewStudent = data === null;
    const isAnotherStudent = data && data.id !== lastEditedStudent;

    if ((isNewStudent && lastEditedStudent !== null) || isAnotherStudent) {
        form.reset();
    }
    
    if(data !== null) {
        const event = new Event('change', {
            bubbles: true,
            cancelable: true
        });

        for (let key in data) {
            var element = form.querySelector("#"+key)
            if(element){
                element.value = data[key]
                element.dispatchEvent(event)
            }
        }

        password.required = false
        password.disabled = true

        //adicionando método put no form
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
    } else {
        password.required = true
        password.disabled = false

        const methodInput = document.querySelector('#formAluno input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
    }

    lastEditedStudent = isNewStudent ? null : data.id;
});