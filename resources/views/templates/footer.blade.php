<footer class="main-footer">
  <strong>Dibuat Dengan <i class="fa fa-heart" aria-hidden="true" style="color:#be1931"></i> Untuk Indonesia</strong> 
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{url('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/dist/js/demo.js')}}"></script>
<!-- page script -->
@yield('script')
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>

</html>