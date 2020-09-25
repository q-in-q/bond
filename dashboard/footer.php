
<!-- Main Footer -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!--Highchart-->
<script type="text/javascript" src="../plugins/highchart/js/highcharts.js"></script>
<script type="text/javascript" src="../plugins/highchart/js/themes/skies.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- bootstrap datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> 
<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page script -->
<script>
$(document).ready(function () {
  <?php if($realtime) { ?>
  function requestData() {
    $.ajax({
      url: "api.php?act=dashboard",
      datatype: 'json',
      success: function (response) {
        console.log(response);

        $('#cpu_load').text(response.data.cpu_load);
        $('#memory').text(response.data.memory);
        $('#hdd').text(response.data.hdd);
        $('#uptime').text(response.data.uptime);
        $('#time').text(response.data.time);
      }
    })
  }

  setInterval(requestData, 1000);
  <?php } ?>
})
</script>
<script>
  var dateToday = new Date(); 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("#dateup").datetimepicker();

    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      minDate: dateToday,
      timePickerIncrement: 1,
      locale: {
        format: 'MMM/D/Y HH:mm:ss'
      }
    })
    $('#laporansq').daterangepicker({
      locale: {
        format: 'Y-MM-DD'
      }
    })
    $('#update_datepickersq').daterangepicker({
      
      timePicker: true,
      timePicker24Hour: true,
      minDate: dateToday,
      timePickerIncrement: 1,
      locale: {
        format: 'MMM/D/Y HH:mm:ss'
      }
    })
    $('#update_datepickerqt').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      minDate: dateToday,
      timePickerIncrement: 1,
      locale: {
        format: 'MMM/D/Y HH:mm:ss'
      }
    })
  })
</script>
<script>
$(function () {
  $("#sq").DataTable({
    "responsive": true,
    "autoWidth": false,
  });
  $("#qt").DataTable({
    "responsive": true,
    "autoWidth": false,
  });
  $("#log").DataTable({
    "responsive": true,
    "autoWidth": false,
    "ordering": false,
  });
  $("#lapsq").DataTable({
    "responsive": true,
    "autoWidth": false,
    "order": [],
  });
  $("#lapqt").DataTable({
    "responsive": true,
    "autoWidth": false,
    "order": [],
  });
  $("#userlist").DataTable({
    "responsive": true,
    "autoWidth": false,
  });
})
$('#editModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var bw = button.data('bw')
  var recipient = button.data('whatever')

  var modal = $(this)
  modal.find('.modal-title').text('Update BOND ' + recipient)
  modal.find('#queueName').val(recipient)
  modal.find('#bandwidth').val(bw)
  modal.find('#idsch').val(id)
})
$('#editModalRun').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var bw = button.data('bw')
  var tglup = button.data('tglup')
  var recipient = button.data('whatever')
  var tgl = button.data('tgl')
  
  var modal = $(this)
  modal.find('#queueName').val(recipient)
  modal.find('#idsch').val(id)
  modal.find('#tglup').val(tglup)
  modal.find('#bw').val(bw)
  modal.find('#bandwidth').val(bw)
  modal.find('#date').val(tgl)
})
$('#editModalQTRun').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var bwup = button.data('bwup')
  var bwdown = button.data('bwdown')
  var tgl = button.data('tgl')
  var tglup = button.data('tglup')
  var id = button.data('id')
  var bwold = button.data('bwold')

  
  var modal = $(this)
  modal.find('#queueName').val(recipient)
  modal.find('#bw-up').val(bwup)
  modal.find('#bw-down').val(bwdown)
  modal.find('#date').val(tgl)
  modal.find('#tglup').val(tglup)
  modal.find('#bwoldup').val(bwup)
  modal.find('#bwolddown').val(bwdown)
  modal.find('#idsch').val(id)
  modal.find('#bwdown').val(bwold)
})

$('#deleteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var bw = button.data('bw')
  var recipient = button.data('whatever')
  
  var modal = $(this)
  modal.find('#deluser').val(recipient)
  modal.find('#idsch').val(id)
  modal.find('#bw-sq').val(bw)
})
$('#deleteModalQT').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var tgl = button.data('tglold')
  var bw = button.data('bw')
  
  var modal = $(this)
  modal.find('#deluser').val(recipient)
  modal.find('#tglqt').val(tgl)
  modal.find('#data-bw').val(bw)

})
$('#editModalQT').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id')
  var recipient = button.data('whatever')
  var bwup = button.data('bwup')
  var bwdown = button.data('bwdown')
  var tglold = button.data('tglold')

  var modal = $(this)
  modal.find('#queueName').val(recipient)
  modal.find('#idschqt').val(id)
  modal.find('#bw-up').val(bwup)
  modal.find('#bw-down').val(bwdown)
  modal.find('#tglold').val(tglold)
})
$('#btnsq').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever') 

  var modal = $(this)
  modal.find('#id').val(recipient)
})
$('#deleteModalUser').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever') 

  var modal = $(this)
  modal.find('#deladmin').val(recipient)
})
$('#editModalUser').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var recipient = button.data('whatever') 

  var modal = $(this)
  modal.find('#Username-id').val(recipient)
  modal.find('#Nama-id').val(id)

})
</script>
</body>
</html>
