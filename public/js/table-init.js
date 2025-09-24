$(document).ready(function () {
  $("table").each(function () {
    $(this).DataTable({
      responsive: true,
      columnDefs: [
        {
          target: "_all",
          defaultContent: "-",
        },
      ],
    });
  });
});