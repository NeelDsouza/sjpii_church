// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "ordering": false,
    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]]
  });
});