<?php include 'components/header.php'; ?>
<!-- iCheck -->
<link href="../assets/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="../assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<body class="nav-md">
  <?php 
    if(empty($_GET['comp_id'])) {
      header('Location: complaint.php');
    }
    if( ($session->logged_in != $session->isAdmin()) && ($session->logged_in != $session->isMaster()) )  {
       header('Location: dashboard.php?redirect=>home=>user='. $session->firstname);
    }
  ?>
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
<?php 
global $database, $session;

$stmt = $database->query("SELECT comp_id FROM " . TBL_COMPLAINT);
$last_id = $stmt->fetch(PDO::FETCH_NUM);
$last_id = $last_id[0];
//echo "<script>alert('". $last_id ."');</script>";

// $last_id = $c['comp_id'];

$last_id = $last_id + 1;

if(isset($_POST['submit'])) {
  $name   = $session->id;
  $dept   = $session->dept_id;
  $ticket = $_POST['ticket'];
  $com    = $_POST['cat_name'];
  $spec   = $_POST['spec_name'];
  $con    = $_POST['cons_name'];
  $subj   = $_POST['subject'];
  $desc   = $_POST['descript'];
  // $file   = $_POST['attach'];
  
  $attach = $_FILES['attach']['name'];
  $size   = $_FILES['attach']['size'];
  $type   = $_FILES['attach']['type'];
  $temp   = $_FILES['attach']['tmp_name'];
  
  move_uploaded_file($temp, 'attachment/' . $attach);
  $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO " . TBL_COMPLAINT . "(user_id, dept_id, ticket, cat_comp_id, cat_spec_id, cat_con_id, subject, description, file, status, req_date) 
           VALUES('$name', '$dept', '$ticket', '$com', '$spec', '$con', '$subj', '$desc', '$attach', 0, NOW())";
  $database->exec($sql);
  $session->message("<div class='alert alert-success'><h3>Well Done!</h3>Complaint Submitted Successfully.</div>");
 }

?>
          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>COMPLAINT FORM</h2>
                  <div class="clearfix"></div>
                </div>
              
                <div class="x_content">
                  <form action="" method="post" class="form-horizontal">

                  <div class="row">
                    <div class="col-md-12">

                       <div class="row">
                          <div class="col-md-4 col-sm-12 col-xs-12 pull-left">
                            <div class="form-group">
                              <label for="" class="control-label">Complainant Name</label> 
                              <input type="text" class="form-control" name="cname" value="<?= $session->firstname . ' ' . $session->lastname; ?>" readonly="readonly" />
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                              <label for="" class="control-label">Department :</label>
                              <input type="text" class="form-control" name="department" value="<?= $session->dept; ?>" readonly="readonly" />
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12 pull-right">
                            <div class="form-group">
                              <label for="" class="control-label">Ticket No.:</label>
                              <input type="text" class="form-control" name="ticket" value="CN-<?= str_pad($last_id, 4, "0000", STR_PAD_LEFT); ?>" readonly="readonly" />
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                              <label for="" class="control-label">Complaint Type:</label>
                              <select name="cat_name" class="form-control cat_name" required="required">
                                  <option value="" disabled="disabled" selected="selected">SELECT COMPLAINT CATEGORY</option>
                                  <?php foreach ($comp_t as $ct): ?>
                                    <option value="<?= $ct['cat_comp_id'] ?>"><?= strtoupper($ct['cat_complaint']); ?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                              <label for="" class="control-label">Specific Complaint:</label>
                              <select name="spec_name" class="form-control spec_name" required="required">
                                <option value="" selected="selected" disabled="disabled">SELECT SPECIFIC CATEGORY</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                              <label for="" class="control-label" >Concern Type:</label>
                              <select name="cons_name" class="form-control cons_name" required="required">
                                <option value="" disabled="disabled" selected="selected">SELECT CONCERN CATEGORY</option>   
                                           
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                              <label for="" class="control-label">Subject:</label> 
                              <input type="text" name="subject" class="form-control" name="subject" placeholder="Subject Complaint" required="required"/>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                              <label for="" class="control-label">Description:</label>
                              <textarea name="descript" rows="5" class="form-control" placeholder="Enter Description &hellip;" required="required"></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label for="" class="control-label">Attachment:</label>
                              <input type="file" name="attach">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <button type="submit" name="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Submit</button>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>

                  </form>
                </div>
              </div>
            </div>      
          </div>
        
        </div>
      </div>
      <!-- /page content -->
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
      <!-- Datarange Picker -->
  <script type="text/javascript" src="../build/daterange/moment.js"></script>
  <script type="text/javascript" src="../build/daterange/daterangepicker.js"></script>
  <!-- Datatables -->
  <script src="../assets/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>

  <!-- Datatables -->
  <script>
      $(document).ready(function() {

        setInterval(function() {
          $('#notify').load('f/get_complaint_count.php');
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
              responsive: true
            });
          }
        };

         $('#ec_date').daterangepicker({
          singleDatePicker: true,
          startDate: moment().subtract(6, 'days')
        });

        $('#datatable3').dataTable({bFilter: false, bInfo: false, "bLengthChange": false, "lengthMenu": [15]});
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

        //TableManageButtons.init();
      });
    </script>
  <!-- /Datatables -->
</body>
</html>