<?php session_start(); ?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ELIT Inventur - Scanner</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.ico">

    <!-- page css -->

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

    <!-- PHP Includes -->
    <?php include 'assets/include/teams_connector.php' ?>
    <?php include 'assets/include/sql.php'; ?>
    <?php include 'assets/include/scanner.php'; ?>

</head>
<body>
    <div class="auth-full-height d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="m-2">
                                <div class="d-flex justify-content-center mt-3">
                                    <div class="text-center logo">
                                        <img alt="logo" class="img-fluid" src="assets/images/logo/logo.png" style="height: 70px;">
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                  <h3 class="fw-bolder">EL/IT Inventursystem</h3>
                                </div></br>
                                  <div class="form-group mb-3">
                                      <center><label class="form-label"><?php echo $scan; ?></label></center>
                                      <input class="form-control" type="text" id="scan" autofocus <?php echo $locked; ?>>
                                  </div>
                                  <center>
                                    <?php echo $button; ?>
                                  </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>

    <script>
        $("#scan").on('change', function(){
            var x = document.getElementById("scan").value;
            window.location.href = "scan.php?id=" + x;
        });
    </script>
</body>

</html>
