<?php include 'cpn/header.php'; ?>
<!-- iCheck -->
<link href="../../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="../../assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<body class="nav-md">
<?php 
$stmt = $database->query("SELECT * FROM " . TBL_COMPLAINT);
$dt = $stmt->fetch(PDO::FETCH_ASSOC);
?>
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
                <div class="x_panel animate">
                  <div class="x_title">
                    <h2>TASK AND DESCRIPTION</h2>
                    <div class="clearfix"></div>
                  </div>
                  <?php 
                    global $database;
                    $tableContent = '';
                    $start = '';
                    $strt = '';
                    $str = '';

                    $stmt = $database->prepare("SELECT * FROM " . TBL_COMPLAINT . " INNER JOIN " . TBL_COMP);
                    $stmt->execute(array(':start' => $start. '%'));
                    $g_allBio = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($g_allBio as $gb) {
                      $time_one = new DateTime($gb['req_date']);
                      $time_two = new DateTime($gb['res_date']);
                      $difference = $time_one->diff($time_two);
                      $tableContent = $tableContent . "<tr>"
                                                      . "<td>". $gb['comp_id'] . "</td>"
                                                      . "<td>". $gb['ticket'] ."</td>"
                                                      . "<td>". $gb['cat_complaint'] ."</td>"
                                                      . "<td>". $gb['subject'] ."</td>"
                                                      . "<td>". $gb['description'] ."</td>"
                                                      . "<td>". ( $gb['status'] == '5' ? "<i class='fa fa-check-square-o'></i> RESOLVED" 
                                                                                       : "<i class='fa fa-exclamation-triangle'></i> PENDING" ) ."</td>"
                                                    . "</tr>";
                    }


                    if(isset($_POST['search_'])) {
                      $start = $_POST['cat_name'];
                      $strt = $_POST['spec_name'];
                      $str = $_POST['cons_name'];
                      $from = date('Y-m-d', strtotime($_POST['fromdate']));
                      $to = date('Y-m-d', strtotime($_POST['todate'])); 
                      $tableContent = '';
                      $stmt = $database->prepare("SELECT *
                                                  FROM " . TBL_COMPLAINT . " c
                                                  INNER JOIN " . TBL_COMP ." cc ON c.cat_comp_id = cc.cat_comp_id
                                                  WHERE c.cat_comp_id LIKE '$start'
                                                  AND c.cat_spec_id LIKE '$strt'
                                                  AND c.cat_con_id LIKE '$str'
                                                  AND DATE(c.req_date) BETWEEN '$from' AND '$to' ");
                      
                      $stmt->execute(array(':start'=>$start.'%', ':start' => $strt. '%', ':start' => $str . '%'));
                      $g_allBio = $stmt->fetchAll();
                      echo "<div> REPORT FROM : <h3>" . date('M. d Y', strtotime($from)) . " TO " . date('M. d Y', strtotime($to)) .  "</h3></div>";
                      foreach ($g_allBio as $gb) {
                        $time_one = new DateTime($gb['req_date']);
                        $time_two = new DateTime($gb['res_date']);
                        $difference = $time_one->diff($time_two);
                        $tableContent = $tableContent . "<tr>"
                                                        . "<td>". $gb['comp_id'] . "</td>"
                                                        . "<td>". $gb['ticket'] ."</td>"
                                                        . "<td>". $gb['cat_complaint'] ."</td>"
                                                        . "<td>". $gb['subject'] ."</td>"
                                                        . "<td>". $gb['description'] ."</td>"
                                                        . "<td>". ( $gb['status'] == '5' ? "<i class='fa fa-check-square-o'></i> RESOLVED" 
                                                                                         : "<i class='fa fa-exclamation-triangle'></i> PENDING" ) ."</td>"
                                                      . "</tr>";
                      }

                    }

            
                  ?>
                  <div class="x_content">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-3">
                          <form action="" method="post" class="form-horizontal">
                            <div>
                              <select name="cat_name" class="form-control cat_name">
                                <option value="" disabled="disabled" selected="selected">SELECT COMPLAINT CATEGORY</option>
                                  <option value="1"<?php if($start == '1') {echo 'selected';} ?> >BIOMEDICAL COMPLAINTS</option>
                                  <option value="2"<?php if($start == '2') {echo 'selected';} ?> >I.T. ISSUES COMPLAINTS</option>
                                  <option value="3"<?php if($start == '3') {echo 'selected';} ?> >MAINTENANCE CONCERNS</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group-btn">
                              <select name="spec_name" class="form-control spec_name" required="required">
                                <option value="" disabled="disabled" selected="selected">SELECT SPECIFIC CATEGORY </option>
                              </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="input-group-btn">
                            <select name="cons_name" class="form-control cons_name" required="required">
                              <option value="" disabled="disabled" selected="selected">SELECT CONCERN CATEGORY</option>   
                            </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                              <div class="input-group">
                                <input type="text" name="fromdate" class="form-control" id="startDate" data-toggle="tooltip" data-placement="top" title="Date Filter: FROM DATE">
                                <span class="input-group-addon">to</span>
                                <input type="text" name="todate" class="form-control" id="endDate" value="2016-10-10" data-toggle="tooltip" data-placement="top" title="Date Filter: TO DATE">
                                <div class="input-group-btn">
                                  <button type="submit" name="search_" class="btn btn-default"><i class="fa fa-search"></i></button>
                                  <a href="rep_c_r_s.php" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
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
                            <th>ID</th>
                            <th>TICKET</th>
                            <th>COMPLAINT TYPE</th>
                            <th>SUBJECT</th>
                            <th>DESCRIPTION</th>
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