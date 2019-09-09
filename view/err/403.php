<?php include '../../include/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SEMOS | Access Denied</title>

    <!-- Bootstrap -->
    <link href="../../assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    <style>
      #refresh {
        border: 2px solid #D7D8D9;
        color: #8A8A8A;
        font-weight: bold;
        background: #2A3F54;
        padding: 10px 50px;
        border-radius: 25px;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">403</h1>
              <h2>Access denied</h2>
              <p>Full authentication is required to access this resource.
              <?php if($session->isAdmin()) { ?>
                  <a href="#">Please contact Programmer</a>
              <?php } else { ?>
                  <a href="#">Please contact your Administrator</a>
              <?php } ?>
              </p>
              <br>
              <br>
              <br>
              <div class="mid_center">
                <form>
                  <div class="col-xs-12 form-group pull-right">
                    <a href="../" id="refresh" class="btn btn-default btn-round"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
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

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
  </body>
</html>