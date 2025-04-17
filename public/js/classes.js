document.getElementById('modalDeletar').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var dataBsId = button.getAttribute('data-bs-id')
    var form = document.getElementById('deleteForm');
    form.action = '/turmas/' + dataBsId;
})

let lastEditedClass = null;

document.getElementById('modalClasses').addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const dataBsData = button.getAttribute('data-bs-data');
    const data = dataBsData ? JSON.parse(dataBsData) : null;
    const form = document.getElementById('formClasses');

    const isNewClass = data === null;
    const isAnotherStudent = data && data.id !== lastEditedClass;

    if ((isNewClass && lastEditedClass !== null) || isAnotherStudent) {
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

        //adicionando método put no form
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
    } else {
        const methodInput = document.querySelector('#formClasses input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
    }

    lastEditedClass = isNewClass ? null : data.id;
});