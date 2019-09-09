<?php 
include 'components/header.php'; 
if(!isset($_GET['comp_id'])) {
  header('Location: dashboard.php');
}

global $database;
$id = $_GET['comp_id'];
try {
  $que = "SELECT co.*, c.*, s.*, cc.*, d.* FROM ". TBL_COMPLAINT ." co
          INNER JOIN ".TBL_COMP." c ON co.cat_comp_id = c.cat_comp_id
          INNER JOIN ".TBL_SPEC." s ON co.cat_spec_id = s.cat_spec_id
          INNER JOIN ".TBL_CONC." cc ON co.cat_con_id = cc.cat_con_id
          INNER JOIN ".TBL_DEPT." d ON co.dept_id = d.dept_id
          WHERE user_id = '" . $session->id . "' AND co.comp_id = '$id' ";
  $q = $database->query($que);
  $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  die("Error: " . $e->getMessage());
}
?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <?php include 'components/nav_title.php'; ?>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile">
             <?php include 'components/profile-quick.php'; ?>
            </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu"
            class="main_menu_side hidden-print main_menu">
        <?php include 'components/sidebar.php'; ?>
            </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
             <?php include 'components/sidebar-footer.php'; ?>
            </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
          <?php include 'components/navbar.php'; ?>
        </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
        <?php if( ($session->logged_in)  && ($session->isMember())) { ?>
          <div class="page-title">
            <div class="title_left">
              <h2>COMPLAINT STATUS</h2>
            </div>
          </div>

          <div class="clearfix"></div>
        <?php 
          while($c = $q->fetch()): 
          $time_one = new DateTime($c['req_date']);
          $time_two = new DateTime($c['res_date']);
          $difference = $time_one->diff($time_two);
        ?>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel control_table">

                <div class="x_title">
                  <h3>COMPLAINT DETAILS</h3>
                </div>

                <div class="x_content">
                  <div class="row">
                    <div class="form-body form-horizontal">
                      
                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Ticket No.:</label>
                        <div class="col-md-7"><?= $c['ticket']; ?></div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Subject:</label>
                        <div class="col-md-7"><?= strtoupper($c['subject']); ?></div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Complaint Type:</label>
                        <div class="col-md-7"><?= strtoupper($c['cat_complaint']); ?></div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Specific Complaint:</label>
                        <div class="col-md-7"><?= strtoupper($c['cat_specific']); ?></div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Concern Type:</label>
                        <div class="col-md-7"><?= strtoupper($c['cat_concern']); ?></div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Description:</label>
                        <div class="col-md-7"><?= ucfirst($c['description']); ?></div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Remarks:</label>
                        <div class="col-md-7"><?= $c['remarks'] ? ucfirst($c['remarks']) : "<i class='fa fa-spinner fa-spin'></i> Processing&hellip;"; ?></div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Requested Date:</label>
                        <div class="col-md-7">
                        <?= date('M. d Y', strtotime($c['req_date'])) .' '.date('h:i A', strtotime($c['req_date'])); ?></div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Resolved Date:</label>
                        <div class="col-md-7">
                          <?= $c['res_date'] == '0000-00-00 00:00:00' ?
                             "<i class='fa fa-spinner fa-spin'></i> Processing&hellip;" 
                             : date('M. d Y', strtotime($c['res_date'])) .' '.date('h:i A', strtotime($c['res_date'])); ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Execution Time:</label>
                        <div class="col-md-7">
                            <?= $c['res_date'] == '0000-00-00 00:00:00' ? 
                             "<i class='fa fa-spinner fa-spin'></i> Processing&hellip;" : 
                             $difference->format('%h hr %i mn'); ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Assisted By:</label>
                        <div class="col-md-7">
                          <?= $c['assisted'] ? 
                             "<i class='fa fa-user'></i> " . ucwords($c['assisted']) : 
                            "<i class='fa fa-spinner fa-spin'></i> REQUESTING&hellip;"; ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="" class="control-label col-md-5">Status:</label>
                        <div class="col-md-7">
                          <?= $c['status'] == 0 ? "<a href='#c_toggle".$c['comp_id']."' data-toggle='modal' class='btn btn-default btn-xs'><i class='fa fa-spinner fa-spin'></i> PROCESSING&hellip;</a>"
                              : ($c['status'] == 1 ? "<a href='#c_toggle".$c['comp_id']."' class='btn btn-success btn-xs'><i class='fa fa-comments-o'></i> ASSISTED</a>"
                              : ($c['status'] == 2 ? "<a href='#c_toggle".$c['comp_id']."' data-toggle='modal' class='btn btn-warning btn-xs'><i class='fa fa-exclamation-triangle'></i> PENDING</a>"
                              : ($c['status'] == 5 ? "<a href='#c_toggle".$c['comp_id']."' data-toggle='modal' class='btn btn-success btn-xs'><i class='fa fa-check-square-o'></i> RESOLVED</a>" : ''))); ?>
                        </div>
                      </div>

                      <hr>
                      <div class="form-group">
                        <a href="dashboard.php" class="btn btn-success col-md-offset-4 col-md-3"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
                      </div>

                      <?php include 'modal/modal_c_toggle.php'; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
        <?php } ?>
        </div>
      </div>
      <!-- /page content -->

      <!-- modal -->
              <!-- /modal -->
      <!-- footer content -->
      <footer>
        <?php include 'components/footer.php'; ?>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="../assets/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../assets/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../assets/nprogress/nprogress.js"></script>

  <!-- Datatables -->
  <script src="../assets/datatables.net/js/jquery.dataTables.min.js"></script>
  <script
    src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <!-- Datarange Picker -->
  <script type="text/javascript" src="../build/daterange/moment.js"></script>
  <script type="text/javascript"
    src="../build/daterange/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
  <!-- Datatables -->
  <script>
      $(document).ready(function() {
        
        setInterval(function() {
          $('.x_contents').load('f/get_complaint.php');
        }, 1000);
        setInterval(function() {
          $('#notify').load('f/get_complaint_count.php');
        }, 1000);
        setInterval(function() {
          $('#user_complaint').load('f/get_user_complaint.php');
        }, 1000);

        // setInterval(function() {
        //   $('#notify').load('f/get_complaint_count.php');
        // }, 1000);

        // var y = document.getElementById("notify").innerHTML;
        // var x = document.getElementById("notify").value = document.getElementById("notify").innerHTML;
        // console.log(x);
        
        // if(x > 10) {
        //  console.log('greater than');
        // } else {
        //  console.log('less than');
        // }

       $(".cat_name").change(function()
       {
        var id = $(this).val();
        var dataString = 'id=' + id;

        $.ajax({
          type: "POST",
          url: "f/get_specific.php",
          data: dataString,
          cache: false,
          success: function(html)
          {
            $(".spec_name").html(html);
          }
        });
       });

       $(".spec_name").change(function()
        {
          var id=$(this).val();
          var dataString = 'id='+ id;

          $.ajax
          ({
            type: "POST",
            url: "f/get_concern.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $(".cons_name").html(html);
            }
          });
        });

        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              responsive: true
            });
          }
        };

        $('#startDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment().subtract(6, 'days')
        });

        $('#endDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment()
        });


        $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable2').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable3').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable4').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [5]});
        $('#datatable5').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        TableManageButtons.init();
      });
    </script>
  <!-- /Datatables -->
</body>
</html>