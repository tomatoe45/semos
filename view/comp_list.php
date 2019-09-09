<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link
  href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css"
  rel="stylesheet">
<link
  href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
  rel="stylesheet">
<link
  href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
  rel="stylesheet">
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
              <h3>COMPLAINT LIST</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel control_table">
                <div class="x_title">
                  <h3>COMPLAINT TABLE</h3>
                </div>
                  <?php
                    global $database;
                    $tableContent = '';
                    $today = date('Y-m-d h:i A');
                    $selectStmt = $database->prepare("SELECT co.*, c.*, s.*, cc.*, d.* FROM ". TBL_COMPLAINT ." co
                                                        INNER JOIN ".TBL_COMP." c ON co.cat_comp_id = c.cat_comp_id
                                                        INNER JOIN ".TBL_SPEC." s ON co.cat_spec_id = s.cat_spec_id
                                                        INNER JOIN ".TBL_CONC." cc ON co.cat_con_id = cc.cat_con_id
                                                        INNER JOIN ".TBL_DEPT." d ON co.dept_id = d.dept_id
                                                        WHERE user_id = '" . $session->id . "' ORDER BY co.comp_id DESC ");
                    $selectStmt->execute();
                    $tasked = $selectStmt->fetchAll();

                    foreach($tasked as $c) {
                        $tableContent = $tableContent   . "<tr>"
                                                        . ($c['cat_comp_id'] == '3' ? "<td class='main_comp c_id' width='50' align='center'>" : "<td class='it_comp' width='50' align='center'>")
                                                        . "<span class='btn btn-rounded btn-danger btn-outline btn-sm'><strong>" . $c['comp_id'] ."</strong></span></td>"
                                                        . "<td> <a href='complaint_status.php?comp_id?=".$c['comp_id']."' class='btn btn-primary btn-rounded btn-outline btn-xs'><i class='fa fa-plus' data-toggle='tooltip' data-placement='top' title='View Details'></i></a>". ucfirst($c['subject']) ."</td>"
                                                        . "<td width='300'>". strtoupper($c['cat_complaint']) ."</td>"
                                                        . "<td width='150'>". ($c['assisted'] ? "<button type='button' class='btn btn-info btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-shield'></i> ".ucwords($c['assisted'])."</button>"
                                                                : '<button type="button" class="btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12"><i class="fa fa-spinner fa-spin"></i> REQUESTING...</button>')."</td>"
                                                        . "<td width='100'>". ($c['status'] == 0 ?
                                                                '<a href="#c_toggle".$c["comp_id"]." data-toggle="modal" class="btn btn-default btn-xs col-md-12 col-sm-12 col-xs-12"><i class="fa fa-spinner fa-spin"></i> PROCESSING...</a>' :
                                                                ($c['status'] == 1 ? '<button type="button" class="btn btn-info btn-xs col-md-12 col-xs-12 col-sm-12"><i class="fa fa-comments"></i> ASSISTED</button>' :
                                                                    ($c['status'] == 2 ? '<button type="button" class="btn btn-warning btn-xs col-md-12 col-sm-12 col-xs-12"><i class="fa fa-exclamation-triangle"></i> PENDING</button>' : (
                                                                        $c['status'] == 5 ? '<button type="button" class="btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12"><i class="fa fa-check-square-o"></i> RESOLVED</button>' : '')))) ."</td>"
                                                        . "</tr>";
                        include 'modal/modal_c_toggle.php';
                        include 'modal/modal_c_details.php';
                    }

                    if(isset($_POST['filter_dash'])) {
                        $start = date('Y-m-d', strtotime($_POST['fromdate']));
                        $end = date('Y-m-d', strtotime($_POST['todate']));
                        $tableContent = '';
                        $selectStmt = $database->prepare("SELECT co.*, c.*, s.*, cc.*, d.* FROM ". TBL_COMPLAINT ." co
                                                        INNER JOIN ".TBL_COMP." c ON co.cat_comp_id = c.cat_comp_id
                                                        INNER JOIN ".TBL_SPEC." s ON co.cat_spec_id = s.cat_spec_id
                                                        INNER JOIN ".TBL_CONC." cc ON co.cat_con_id = cc.cat_con_id
                                                        INNER JOIN ".TBL_DEPT." d ON co.dept_id = d.dept_id
                                                        WHERE DATE(co.req_date) BETWEEN '$start' AND '$end' AND user_id = '".$session->id."' ");
                        $selectStmt->execute();
                        $tasked = $selectStmt->fetchAll(PDO::FETCH_ASSOC);
                        echo "<div>FILTER RANGE: <h3> FROM ".date('M. d Y', strtotime($start))." TO " . date('M. d Y', strtotime($end)) . "</h3></div>";
                        foreach($tasked as $c) {
                            $tableContent = $tableContent   . "<tr>"
                                . ($c['cat_comp_id'] == '3' ? "<td class='main_comp c_id' width='50' align='center'>" : "<td class='it_comp' width='50' align='center'>")
                                . "<span class='btn btn-rounded btn-danger btn-outline btn-sm'><strong>" . $c['comp_id'] ."</strong></span></td>"
                                . "<td> <a href='complaint_status.php?comp_id?=".$c['comp_id']."' class='btn btn-primary btn-rounded btn-outline btn-xs'><i class='fa fa-plus' data-toggle='tooltip' data-placement='top' title='View Details'></i></a>". ucfirst($c['subject']) ."</td>"
                                . "<td width='300'>". strtoupper($c['cat_complaint']) ."</td>"
                                . "<td width='150'>". ($c['assisted'] ? "<button type='button' class='btn btn-info btn-xs col-md-12 col-sm-12 col-xs-12'><i class='fa fa-shield'></i> ".ucwords($c['assisted'])."</button>"
                                    : '<button type="button" class="btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12"><i class="fa fa-spinner fa-spin"></i> REQUESTING...</button>')."</td>"
                                . "<td width='100'>". ($c['status'] == 0 ?
                                    '<a href="#c_toggle".$c["comp_id"]." data-toggle="modal" class="btn btn-default btn-xs col-md-12 col-sm-12 col-xs-12"><i class="fa fa-spinner fa-spin"></i> PROCESSING...</a>' :
                                    ($c['status'] == 1 ? '<button type="button" class="btn btn-info btn-xs col-md-12 col-xs-12 col-sm-12"><i class="fa fa-comments"></i> ASSISTED</button>' :
                                        ($c['status'] == 2 ? '<button type="button" class="btn btn-warning btn-xs col-md-12 col-sm-12 col-xs-12"><i class="fa fa-exclamation-triangle"></i> PENDING</button>' : (
                                        $c['status'] == 5 ? '<button type="button" class="btn btn-success btn-xs col-md-12 col-sm-12 col-xs-12"><i class="fa fa-check-square-o"></i> RESOLVED</button>' : '')))) ."</td>"
                                . "</tr>";
                            include 'modal/modal_c_toggle.php';
                            include 'modal/modal_c_details.php';
                        }
                    }
                  ?>
                  <form action="" method="post" class="form-horizontal">
                      <div class="title_right">
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <div class="input-group">
                                    <input type="text" name="fromdate" class="form-control" id="startDate" value="2012-04-05">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" name="todate" class="form-control" id="endDate" value="2012-04-19">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" name="filter_dash">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                              </div>
                          </div>
                      </div>
                  </form>
                <div class="clearfix"></div>
                  <input  type="text" name="filter" class="form-control search_filter" placeholder="Search..."/>
                <br />
                <div class="user_complaint" class="x_content">
                    <table id="datatable1" class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th data-toggle="tooltip" data-placeholder="top" title="Complaint ID">ID</th>
                                <th data-toggle="tooltip" data-placeholder="top" title="Subject Complaint">SUBJECT</th>
                                <th data-toggle="tooltip" data-placeholder="top" title="Description of Complaint">COMPLAINT TYPE</th>
                                <th data-toggle="tooltip" data-placeholder="top" title="Assisted Complaint"><i class="fa fa-shield"></i> ASSISTED BY</th>
                                <th data-toggle="tooltip" data-placeholder="top" title="Complaint Status">STATUS</th>
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
        <?php } elseif( ($session->logged_in) && ($session->isMaster())) { ?>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel control_table">
                <div class="x_title">
                  <h2>COMPLAINT LISTS</h2>
                  <div class="clearfix"></div>
                  <?= $session->message; ?>
                </div>
                <div class="x_content">
                  <div class="x_contents"></div>
                </div>
              </div>
            </div>

          </div>
        <?php } ?>
        </div>
      </div>
      <!-- /page content -->

      <!-- modal -->
        <?php include 'modal/modal_mk_c.php'; ?>
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
  <script src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <!-- Datarange Picker -->
  <script type="text/javascript" src="../build/daterange/moment.js"></script>
  <script type="text/javascript"
    src="../build/daterange/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
  <!-- Datatables -->
  <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              responsive: true
            });
          }
        };

        $('.search_filter').keyup(function() {
            search_table($(this).val());
        });

        function search_table(value) {
            $('#datatable1 tbody tr').each(function() {
                var found = 'false';
                $(this).each(function() {
                   if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                       found = 'true';
                   }
                });
                if(found == 'true') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

          $('#startDate').daterangepicker({
              singleDatePicker: true,
              startDate: moment().subtract(6, 'days')
          });

          $('#endDate').daterangepicker({
              singleDatePicker: true,
              startDate: moment()
          });

        $('#datatable1').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [10]});

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