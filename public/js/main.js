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

$('table').each(function () {
  const validRows = $(this).find('tbody tr').filter(function () {
    return $(this).find('td[colspan]').length === 0;
  });

  if (validRows.length > 0) {
    $(this).DataTable({
      "searching": false,
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
      "order": [],
      "columnDefs": [
        { width: "5%", "targets": [-1] },
        { orderable: false, "targets": [-1] },
        { orderable: true, className: 'reorder', "targets": '_all' },
        { className: "dt-center", "targets": "_all" }
      ],
      "paging": false,
      "info": false,
    });
  }
});
