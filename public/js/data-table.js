
$(document).ready(function() {
  $('#dbTable').DataTable({
    dom: 'lBfrtip',
    buttons: [
      {
        extend: 'print',
        attr: {
          id: 'btn_datatable_print'
        },
        text: '<i class="fas fa-print"></i> Print',
        customize: function(win) {
          $(win.document.head).find('title').css('font-size', '50px');
          $(win.document.head).append('<style>table { font-size: 8px; } table thead th { font-size: 12px; } table tbody td { font-size: 12px; }</style>'); // add a style element to the document head with the desired font sizes
          $(win.document.body).find('table thead th').not(':last-child').show(); // show all th tags except for last child
          $(win.document.body).find('table tbody td:not(:last-child)').show(); // show all td tags except for last child
          $(win.document.body).find('table thead th:last-child').hide(); // hide last th tag (Actions)
          $(win.document.body).find('table tbody td:last-child').hide(); // hide last td tag (Actions)
        }
      },
      {
        extend: 'pdf',
        attr: {
          id: 'btn_datatable_pdf'
        },
        text: '<i class="fas fa-file-pdf"></i> PDF',
        customize: function(doc) {
          // Remove the last column from each row in the table
          var lastColumnIndex = doc.content[1].table.body[0].length - 1;
          for (var i = 0; i < doc.content[1].table.body.length; i++) {
            doc.content[1].table.body[i].splice(lastColumnIndex, 1);
          }
          
          // Set the width of the table to 100%
          var table = doc.content[1].table;
          table.widths = Array(table.body[0].length + 1).join('*').split('');
          table.widths.splice(-1, 1, 'auto');
          table.width = '100%';
        } 
      },
      {
        extend: 'excel',
        attr: {
            id: 'btn_datatable_excel'
        },
        text: '<i class="fas fa-file-excel"></i> Excel',
        customize: function(xlsx) {
          var sheet = xlsx.xl.worksheets['sheet1.xml'];
          var lastColumnIndex = $('col', sheet).length - 1;
          $('tr th:eq(' + lastColumnIndex + ')', sheet).remove();
          $('tr td:eq(' + lastColumnIndex + ')', sheet).remove();
      }   
      }
    ],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
  });
});
