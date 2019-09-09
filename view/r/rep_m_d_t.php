<?php include 'cpn/header.php'; ?>
<!-- iCheck -->
<link href="../../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="../../assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<style type="text/css" media="screen">
  .rep{
    padding-bottom: 10px;
  }
</style>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <?php include 'cpn/nav_title.php'; ?>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile">
             <?php include 'cpn/profile-quick.php'; ?>
            </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <?php include 'cpn/sidebar.php'; ?>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
             <?php include 'cpn/sidebar-footer.php'; ?>
            </div>
          <!-- /menu footer buttons -->
        </div>
      </div>
      <!-- top navigation -->
      <div class="top_nav">
          <?php include 'cpn/navbar.php'; ?>
      </div>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          
        <div class="page-title animate fadeInUp">
              <div class="title_left">
                <h2>COMPLAINT REPORT AND STATUS</h2>
              </div>
              <div class="title_right">
                <div class="pull-right">
                  <a href="../reports.php" class="btn btn-default btn-rounded"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_title">
                    <h2>MAINTENANCE DAILY / TASKS LOG </h2>
                    <div class="clearfix"></div>
                  </div>
                  <?php 
                    global $database;
                    $tableContent = '';
                    $start = '';
                    $strt = '';

                    $stmt = $database->prepare("SELECT * FROM " . TBL_TASK );
                    $stmt->execute(array(':start' => $start. '%' , ':start' => $strt . '%'));
                    $tasked = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    

                    foreach ($tasked as $tk) {
                      $time_one = new DateTime($tk['exec_date']);
                      $time_two = new DateTime($tk['res_date']);
                      $difference = $time_one->diff($time_two);
                      $tableContent = $tableContent . "<tr>"
                                                      . "<td>" . $tk['task_id'] . "</td>"
                                                      . "<td>" . $tk['ticket'] . "</td>"
                                                      . "<td>" . ucfirst($tk['task_subject']) . "</td>"
                                                      . "<td>" . date('M. d Y', strtotime($tk['exec_date'])) . "<br>" . date('h:i A', strtotime($tk['exec_date'])) . "</td>"
                                                      . "<td>" . ($tk['res_date'] != '0000-00-00 00:00:00' ? $difference->format('%h hrs <br> %i minutes') : '...') ."</td>"
                                                      . "<td>" . ucwords($tk['exec_name']) ."</td>"
                                                      . "<td>" . ($tk['status'] == 1 ? "<i class='fa fa-shield'></i> RESOLVED" : "<i class='fa fa-exclamation-triangle'></i> PENDING") ."</td>"
                                                    . "</tr>";
                    }


                    if(isset($_POST['search_'])) {
                      $start = $_POST['status'];
                      $strt = $_POST['tech_name'];
                      $from = date('Y-m-d', strtotime($_POST['fromdate']));
                      $to = date('Y-m-d', strtotime($_POST['todate']));
                      $tableContent = '';
                      $stmt = $database->prepare("SELECT * FROM " . TBL_TASK . " 
                                                    WHERE exec_name LIKE '%" . $strt . "%'
                                                    AND status LIKE '%" . $start . "%'
                                                    AND DATE(exec_date) BETWEEN '$from' AND '$to' ");
                      $stmt->execute(array(':start'=>$start.'%', ':start' => $strt.'%'));
                      $tasked = $stmt->fetchAll();
                      echo "<div> REPORT FROM : <h3>" . date('M. d Y', strtotime($from)) . " TO " . date('M. d Y', strtotime($to)) .  "</h3></div>";
                      foreach ($tasked as $tk) {
                      $time_one = new DateTime($tk['exec_date']);
                      $time_two = new DateTime($tk['res_date']);
                      $difference = $time_one->diff($time_two);
                      $tableContent = $tableContent . "<tr>"
                                                      . "<td>" . $tk['task_id'] . "</td>"
                                                      . "<td>" . $tk['ticket'] . "</td>"
                                                      . "<td>" . ucfirst($tk['task_subject']) . "</td>"
                                                      . "<td>" . date('M. d Y', strtotime($tk['exec_date'])) . "<br>" . date('h:i A', strtotime($tk['exec_date'])) . "</td>"
                                                      . "<td>" . ($tk['res_date'] != '0000-00-00 00:00:00' ? $difference->format('%h hrs <br> %i minutes') : '...') ."</td>"
                                                      . "<td>" . ucwords($tk['exec_name']) ."</td>"
                                                      . "<td>" . ($tk['status'] == 1 ? "<i class='fa fa-shield'></i> RESOLVED" : "<i class='fa fa-exclamation-triangle'></i> PENDING") ."</td>"
                                                    . "</tr>";
                      }

                    }

         
                  ?>
                  <div class="x_content">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-4">
                          <form action="" method="post" class="form-horizontal">
                            <div>
                              <select name="tech_name" class="form-control dept_n" data-toggle="tooltip" data-placement="top" title="Filter: By Technical">
                                <option value="">ALL</option>
                                <?php foreach ($t_users as $tu): ?>
                                  <option value="<?= $tu['firstname'] . ' ' . $tu['lastname']; ?>" <?php $id = $tu['firstname'] . ' ' . $tu['lastname']; if($strt == $id) {echo 'selected';}; ?> > <?= strtoupper($tu['firstname'] . ' ' . $tu['lastname']); ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                              <div class="input-group-btn">
                                <select name="status" class="form-control" data-toggle="tooltip" data-placement="top" title="Filter: By Status">
                                  <option value="">ALL</option>
                                  <option value="0" <?php if($start == '0') {echo 'selected';} ?> >PENDING</option>
                                  <option value="1" <?php if($start == '1') {echo 'selected';} ?> >RESOLVED</option>
                                </select>
                              </div>
                        </div>

                        <div class="col-md-4">
                              <div class="input-group">
                                <input type="text" name="fromdate" class="form-control" id="startDate" data-toggle="tooltip" data-placement="top" title="Date Filter: FROM DATE">
                                <span class="input-group-addon">to</span>
                                <input type="text" name="todate" class="form-control" id="endDate" data-toggle="tooltip" data-placement="top" title="Date Filter: TO DATE">
                                <div class="input-group-btn">
                                  <button type="submit" name="search_" class="btn btn-default"><i class="fa fa-search"></i></button>
                                  <a href="rep_m_d_t.php" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
                                </div>
                              </div>
                          </form>
                        </div>
                        
                      </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <table id="datatable-buttons" name="ta" class="table table-hover ta">
                        <thead>
                          <tr>
                            <th width="30">ID</th>
                            <th width="70">TICKET</th>
                            <th>SUBJECT</th>
                            <th width="120">DATE/TIME EXC</th>
                            <th width="120">ESTIMATED TIME</th>
                            <th width="90">EXECUTED BY</th>
                            <th width="100">STATUS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?= $tableContent; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>
      <!-- /page content -->
      <!-- modal -->
      <!-- /modal -->
      <!-- footer content -->
      <footer>
          <?php include 'cpn/footer.php'; ?>
        </footer>
      <!-- /footer content -->
    </div>
  </div>
   <!-- jQuery -->
  <script src="../../assets/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../../assets/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../../assets/nprogress/nprogress.js"></script>
  <!-- Datatables -->
  <script src="../../assets/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../../assets/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../../assets/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../../assets/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../../assets/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../../assets/pdfmake/build/pdfmake.min.js"></script>
  <script src="../../assets/pdfmake/build/vfs_fonts.js"></script>
  <!-- Datarange Picker -->
  <script type="text/javascript" src="../../build/daterange/moment.js"></script>
  <script type="text/javascript" src="../../build/daterange/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../../build/js/custom.min.js"></script>

  <!-- Datatables -->
  <script>
      $(document).ready(function() {
 setInterval(function() {
          $('#notify').load('../f/get_complaint_count.php');
        }, 1000);

        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-xs"
                },
                {
                  extend: "csv",
                  className: "btn-xs"
                },
                {
                  extend: "excel",
                  className: "btn-xs"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-xs"
                },
                {
                  extend: "print",
                  className: "btn-xs"
                },
              ],
              responsive: true
            });
          }
        };

        $('#startDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment(),
	  locale: {
	   format: 'MM/01/YYYY'
	  }
        });

        $('#endDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment()
        });
        
        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();


        $('#datatable1').dataTable();
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