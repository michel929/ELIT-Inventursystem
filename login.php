<?php
  session_start();
  if(isset($_SESSION["userID"])) {
    session_unset();
    session_destroy();
    die();
  }
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ELIT Inventur - Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.ico">

    <!-- page css -->

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

    <!-- PHP Includes -->
    <?php include 'assets/include/teams_connector.php' ?>
    <?php include 'assets/include/sql.php'; ?>
</head>

<body>
    <div class="auth-full-height">
        <div class="row m-0">
            <div class="col p-0 auth-full-height" style="background-image: url('assets/images/others/bg-1.jpg'); background-repeat: no-repeat; background-size: cover;   filter: blur(8px); -webkit-filter: blur(8px);">
                <div class="d-flex justify-content-between flex-column h-100 px-5 py-3">
                    <div></div>
                </div>
            </div>
            <div class="col-12 p-0 auth-full-height bg-white" style="max-width: 450px;">
                <div class="d-flex h-100 align-items-center p-5">
                    <div class="w-100">
                        <div class="d-flex justify-content-center mt-3">
                            <div class="text-center logo">
                                <img alt="logo" class="img-fluid" src="assets/images/logo/logo.png" style="height: 70px;">
                            </div>
                        </div>
                        <div class="mt-4">
                            <form action="login.php" method="POST">
                                <div class="form-group mb-3">
                                    <label class="form-label">uC / userID</label>
                                    <input class="form-control" type="text" name="uC" />
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Anmelden</button>
                            </form>
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

</body>
</html>

<?php
  if(isset($_POST["uC"])) {
    $userID = $_POST["uC"];
    $sql = "SELECT * FROM users WHERE id = '$userID' and admin='1'";
    foreach ($pdo->query($sql) as $row) {
      $ok = $row["username"];
    }
    if(!isset($ok)) {
      echo "<script>alert('Ungültiger Benutzer: " . $userID . "');</script>";
      die();
    } else {
      $_SESSION["userID"] = $userID;
      $_SESSION["benutzername"] = $ok;
      echo("<script>window.location.replace('/');</script>");
    }
  }
?>
