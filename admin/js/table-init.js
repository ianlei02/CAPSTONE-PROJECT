$(document).ready(function () {
  $("table").each(function () {
    $(this).DataTable({
      responsive: true,
      pageLength: 10, 
      lengthMenu: [5, 10, 25, 50, 100], 
      columnDefs: [
        {
          targets: "_all", 
          defaultContent: "-", 
        },
      ],
    });
  });
});
