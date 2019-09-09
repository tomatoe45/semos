<?php include 'cpn/header.php'; ?>
<!-- iCheck -->
<link href="../../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="../../assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
          
        <div class="page-title">
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
                <div class="x_panel">
                  <div class="x_title">
                    <h2>I.T. ISSUES COMPLAINT REPORT </h2>
                    <div class="clearfix"></div>
                  </div>
                 <?php 
                  global $database;
                  $tableContent = '';
                  $start = '';
                  $strt = '';

                  $stmt = $database->prepare("SELECT * FROM " . TBL_COMPLAINT . " WHERE cat_comp_id = '2' AND status BETWEEN '2' AND '5' ");
                  $stmt->execute(array(':start' => $start. '%'));
                  $g_allIT = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  
                  foreach ($g_allIT as $it) {
                    $time_one = new DateTime($it['req_date']);
                    $time_two = new DateTime($it['res_date']);
                    $difference = $time_one->diff($time_two);
                    $tableContent = $tableContent . "<tr>"
                                                    . "<td>" . $it['comp_id'] . "</td>"
                                                    . "<td>". $it['ticket'] ."</td>"
                                                    . "<td>". $it['subject'] ."</td>"
                                                    . "<td>". date('M. d Y', strtotime($it['req_date'])) . "<br>" . date('h:i A', strtotime($it['req_date'])) ."</td>"
                                                    . "<td>". ( $it['res_date'] != '0000-00-00 00:00:00' ? date('M. d Y', strtotime($it['res_date'])) . "<br>" . date('h:i A', strtotime($it['res_date'])) : '...') ."</td>"
                                                    . "<td>". ($it['res_date'] != '0000-00-00 00:00:00' ? $difference->format('%h hrs <br> %i minutes') : '...') ."</td>"
                                                    . "<td>". ucwords($it['assisted']) ."</td>"
                                                    . "<td>". ($it['status'] == 5 ? "<i class='fa fa-check-square-o'></i> RESOLVED"
                                                                                  : ($it['status'] == 2 ? "<i class='fa fa-exclamation-triangle'></i> PENDING"
                                                                                  : "<i class='fa fa-exclamation-triangle'></i> PENDING")) ."</td>"
                                                  . "</tr>";
                  }

                  if(isset($_POST['search_'])) {
                    $start = $_POST['status'];
                    $strt = $_POST['dept_n'];
                    $from = date('Y-m-d', strtotime($_POST['fromdate']));
                    $to = date('Y-m-d', strtotime($_POST['todate']));
                    $tableContent = '';
                    $stmt = $database->prepare("SELECT c.*, cc.* FROM " . TBL_COMPLAINT . " c 
                                               INNER JOIN " . TBL_COMP . " cc ON cc.cat_comp_id = c.cat_comp_id
                                               INNER JOIN " . TBL_DEPT . " d ON c.dept_id = d.dept_id
                                               WHERE d.dept_id LIKE '%".$strt."%'
                                               AND c.status LIKE '%".$start."%' 
                                               AND c.cat_comp_id = '2'
                                               AND DATE(c.req_date) BETWEEN '$from' AND '$to'
                                               AND c.status BETWEEN '2' AND '5' ");

                    $stmt->execute(array(':start'=>$strt.'%', ':start' => $start.'%'));
                    $g_allIT = $stmt->fetchAll();
                    echo "<div> REPORT FROM : <h3>" . date('M. d Y', strtotime($from)) . " TO " . date('M. d Y', strtotime($to)) .  "</h3></div>";
                    foreach ($g_allIT as $it) {
                      $time_one = new DateTime($it['req_date']);
                    $time_two = new DateTime($it['res_date']);
                    $difference = $time_one->diff($time_two);
                      $tableContent = $tableContent . "<tr>"
                                                      . "<td>" . $it['comp_id'] . "</td>"
                                                      . "<td>". $it['ticket'] ."</td>"
                                                      . "<td>". $it['subject'] ."</td>"
                                                      . "<td>". date('M. d Y', strtotime($it['req_date'])) . "<br>" . date('h:i A', strtotime($it['req_date'])) ."</td>"
                                                      . "<td>". ( $it['res_date'] != '0000-00-00 00:00:00' ? date('M. d Y', strtotime($it['res_date'])) . "<br>" . date('h:i A', strtotime($it['res_date'])) : '...') ."</td>"
                                                      . "<td>". ($it['res_date'] != '0000-00-00 00:00:00' ? $difference->format('%h hrs <br> %i minutes') : '...') ."</td>"
                                                      . "<td>". ucwords($it['assisted']) ."</td>"
                                                      . "<td>". ($it['status'] == 5 ? "<i class='fa fa-check-square-o'></i> RESOLVED"
                                                                                    : ($it['status'] == 2 ? "<i class='fa fa-exclamation-triangle'></i> PENDING"
                                                                                    : "<i class='fa fa-exclamation-triangle'></i> PENDING")) ."</td>"
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
                              <select name="dept_n" class="form-control dept_n" data-toggle="tooltip" data-placement="top" title="Filter: By Department">
                                <option value="">ALL</option>
                                <?php foreach ($depts as $dept): ?>
                                  <option value="<?= $dept['dept_id']; ?>" <?php $id = $dept['dept_id']; if($strt == $id) {echo 'selected';} ?> >
                                  <?= strtoupper($dept['dept_name']); ?></option>
                                <?php endforeach ?> 
                              </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group-btn">
                              <select name="status" class="form-control" data-toggle="tooltip" data-placement="top" title="Filter: By Status">
                                <option value="">ALL</option>
                                <option value="2" <?php if($start == '2') {echo 'selected';} ?> >PENDING</option>
                                <option value="5" <?php if($start == '5') {echo 'selected';} ?> >RESOLVED</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <form action="" method="post" class="form-horizontal">
                              <div class="input-group">
                                <input type="text" name="fromdate" class="form-control" id="startDate" value="2016-10-04" data-toggle="tooltip" data-placement="top" title="Date Filter: FROM DATE">
                                <span class="input-group-addon">to</span>
                                <input type="text" name="todate" class="form-control" id="endDate" value="2016-10-10" data-toggle="tooltip" data-placement="top" title="Date Filter: TO DATE">
                                <div class="input-group-btn">
                                  <button type="submit" name="search_" class="btn btn-default"><i class="fa fa-search"></i></button>
                                  <a href="rep_it_c_r.php" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
                                </div>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <table id="datatable-buttons" class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>TICKET</th>
                            <th>SUBJECT</th>
                            <th>DATE/TIME REQ</th>
                            <th>DATE/TIME RES</th>
                            <th>ESTIMATED TIME</th>
                            <th>ASSISTED BY</th>
                            <th>STATUS</th>
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
  <script src="../../assets/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../../assets/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../../assets/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../../assets/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../../assets/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../../assets/pdfmake/build/pdfmake.min.js"></script>
  <script src="../../assets/pdfmake/build/vfs_fonts.js"></script>
  <!-- DateRange Picker -->
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