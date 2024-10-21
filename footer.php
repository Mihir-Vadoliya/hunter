 <!-- Main Footer -->
 <footer class="main-footer">
     <strong>Copyright &copy; 2023-2024 Hunter.</strong>
     All rights reserved.
     <div class="float-right d-none d-sm-inline-block">
         <b>Version</b> 3.0.4
     </div>
 </footer>
 </div>
 <!-- ./wrapper -->

 <!-- REQUIRED SCRIPTS -->
 <!-- jQuery -->
 <script src="./public/plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap -->
 <script src="./public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="./public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 <script src="./public/dist/js/adminlte.js"></script>

 <!-- OPTIONAL SCRIPTS -->
 <script src="./public/dist/js/demo.js"></script>

 <!-- PAGE PLUGINS -->
 <!-- jQuery Mapael -->
 <script src="./public/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
 <script src="./public/plugins/raphael/raphael.min.js"></script>
 <script src="./public/plugins/jquery-mapael/jquery.mapael.min.js"></script>
 <script src="./public/plugins/jquery-mapael/maps/usa_states.min.js"></script>
 <!-- ChartJS -->
 <script src="./public/plugins/chart.js/Chart.min.js"></script>

 <!-- PAGE SCRIPTS -->
 <script src="./public/dist/js/pages/dashboard2.js"></script>

 <!-- DataATables -->
 <script src="./public/plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="./public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="./public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="./public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <!-- AdminLTE App -->
 <script src="{{ asset('theme/dist/js/adminlte.min.js') }}"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="{{ asset('theme/dist/js/demo.js') }}"></script>
 <script type="text/javascript">
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 </script>
 <!-- page script -->
 <script>
     $(function() {
         $("#adminTabledata").DataTable({
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

 <script>
     function chcekcreate() {
         return confirm('Are You Want To Delete ?');
     }
 </script>
 </body>

 </html>