<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<style href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"></style>
<script>
     jQuery('#financial_report_by_user').DataTable({
          order:[[0,"asc"]]
    });
jQuery('.entry-title').text(`<?php echo $get_client_user_name->report_title ?>`);
</script>