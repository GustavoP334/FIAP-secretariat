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

function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }

    let digito1 = 11 - (soma % 11);
    if (digito1 >= 10) digito1 = 0;

    if (digito1 !== parseInt(cpf.charAt(9))) return false;

    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }

    let digito2 = 11 - (soma % 11);
    if (digito2 >= 10) digito2 = 0;

    return digito2 === parseInt(cpf.charAt(10));
}

function onCpfKeyUp(input) {
    const cpfValido = validarCPF(input.value);
    input.style.borderColor = cpfValido ? 'green' : 'red';
}

function aplicarMascaraCPF(input) {
    let valor = input.value.replace(/\D/g, '');

    if (valor.length > 11) valor = valor.slice(0, 11);

    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    input.value = valor;
}

function validarSenha(senha) {
    const minCaracteres = senha.length >= 8;
    const temMaiuscula = /[A-Z]/.test(senha);
    const temMinuscula = /[a-z]/.test(senha);
    const temNumero = /\d/.test(senha);
    const temSimbolo = /[!@#$%^&*(),.?":{}|<>]/.test(senha);

    document.getElementById("8caracteres").style.color = minCaracteres ? "green" : "red";
    document.getElementById("maiuscula").style.color = temMaiuscula ? "green" : "red";
    document.getElementById("minusculas").style.color = temMinuscula ? "green" : "red";
    document.getElementById("numeros").style.color = temNumero ? "green" : "red";
    document.getElementById("simbolos").style.color = temSimbolo ? "green" : "red";
}