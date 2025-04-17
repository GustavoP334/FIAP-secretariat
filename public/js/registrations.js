$(document).ready(function () {
    const selectizeStudent = $('#selectStudent').selectize({
        plugins: ['remove_button', 'clear_button'],
        maxItems: null,
        closeAfterSelect: false,
    });

    const selectizeInstance = selectizeStudent[0].selectize;

    var registrationTable = null;

    if ($.fn.DataTable.isDataTable('#registrationTable')) {
        $('#registrationTable').DataTable().destroy();
    }

    registrationTable = $("#registrationTable").DataTable({
        "columns": [
            { data: 'name', title: 'Aluno' },
            { data: 'document', title: 'Documento' },
            { 
                data: 'registered_at', 
                title: 'Data da entrada na Turma',
                render: function (data) {
                    const date = new Date(data);
                    const formatted = date.toLocaleDateString('pt-BR') + ' ' + date.toLocaleTimeString('pt-BR');
                    return formatted;
                }
            },
            {
              data: null,
              title: 'Ações',
              orderable: false,
              render: function (row) {
                return `<button type="button" class="btn btn-sm btn-danger" id="deleteStudent" data-bs-student="${row.id}" data-bs-toggle="modal" data-bs-target="#modalDeletar">
                    <i class="fa-solid fa-trash"></i>
                </button>`;
              }
            }
        ],
        "searching": true,
        "responsive": {
            breakpoints: [
                { name: 'bigdesktop', width: Infinity },
                { name: 'meddesktop', width: 1480 },
                { name: 'smalldesktop', width: 1280 },
                { name: 'medium', width: 1188 },
                { name: 'tabletl', width: 1024 },
                { name: 'btwtabllandp', width: 848 },
                { name: 'tabletp', width: 768 },
                { name: 'mobilel', width: 480 },
                { name: 'mobilep', width: 320 }
            ]
        },
        "ordering": true,
        "order": [[0, 'asc']],
        "columnDefs": [
            { width: "5%", "targets": [-1] },
            { orderable: false, "targets": [-1] },
            { orderable: true, className: 'reorder', "targets": '_all' },
            { className: "dt-center", "targets": "_all" }
        ],
        "paging": true,
        "info": true,
        "language": {
            "info": "Exibindo _START_ de _END_ Alunos (Total: _TOTAL_) ",
            "emptyTable":     "Nenhum Aluno matriculado",
            "loadingRecords": "Carregando...",
            "lengthMenu":     "Exibir _MENU_ Alunos",
            "search": "Encontrar aluno:",
            "zeroRecords":    "Nenhum aluno encontrado",
            "infoFiltered": "(filtrado de _MAX_ Alunos)",
            "paginate": {
                "first":      "Primeira",
                "last":       "Última",
                "next":       "Próxima",
                "previous":   "Anterior"
            },
        }
    });

    let lastEditedRegistration = null;

    document.getElementById('modalClasses').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const dataBsData = button.getAttribute('data-bs-data');
        const data = dataBsData ? JSON.parse(dataBsData) : null;
        const form = document.getElementById('formClasses');

        const isNewRegistration = data === null;
        const isAnotherRegistration = data && data.id !== lastEditedRegistration;

        if ((isNewRegistration && lastEditedRegistration !== null) || isAnotherRegistration) {
            form.reset();
            selectizeInstance.clear();
        }

        if(data !== null) {
            for (let key in data) {
                var element = form.querySelector("#"+key)
                if(element){
                    element.value = data[key]
                }
            }
        }

        var students = JSON.parse(data.students)
        
        if(students.length > 0){
            registrationTable.clear().rows.add(students).draw();
        } else {
            registrationTable.clear().draw()
        }

        lastEditedRegistration = isNewRegistration ? null : data.id;
    });

    document.getElementById('modalDeletar').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var dataBsStudent = button.getAttribute('data-bs-student')
        var form = document.getElementById('deleteForm');
        form.action = '/matriculas/' + lastEditedRegistration + '/' + dataBsStudent;
    })
});