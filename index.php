<?php session_start(); ?>
<?php if(!isset($_SESSION["userID"])) { header('Location: /login.php'); die; } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ELIT Inventur - Startseite</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.ico">

    <!-- page css -->
    <link href="assets/vendors/apexcharts/dist/apexcharts.css" rel="stylesheet">

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

    <!--- PHP Includes -->
    <?php include 'assets/include/sql.php' ?>
    <?php include 'assets/include/items_listshort.php' ?>
    <?php include 'assets/include/users_listshort.php' ?>
    <?php include 'assets/include/categories_listshort.php' ?>
    <?php include 'assets/include/actions_listshort.php' ?>
</head>

<body>
    <div class="layout">
        <div class="vertical-layout">
            <!-- Header START -->
            <?php include 'assets/include/navbar_top.php' ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php include 'assets/include/navbar_side.php' ?>
            <!-- Side Nav END -->

            <!-- Content START -->
            <div class="content">
                <div class="main">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                      <h4 class="mb-3">Gegenstände</h4>
                                      <a href="gegenstandverwaltung.php"><button class="btn btn-outline-secondary btn-sm">Alle Gegenstände</button></a>
                                    </div>
                                    <table class="table table-hover mt-2">
                                        <thead>
                                            <tr>
                                                <th>Gegenstand</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $kurzeListe; ?>
                                        </tbody>
                                    </table>
                                    <?php echo $kurzeListeHinweis; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="main">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="card">
                                  <div class="card-body">
                                      <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h4 class="mb-3">Nutzer</h4>
                                        <a href="nutzerverwaltung.php"><button class="btn btn-outline-secondary btn-sm">Alle Nutzer</button></a>
                                      </div>
                                      <table class="table table-hover mt-2">
                                          <thead>
                                              <tr>
                                                  <th>Mitarbeiter</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php echo $kurzeListe2; ?>
                                          </tbody>
                                      </table>
                                      <?php echo $kurzeListeHinweis2; ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  <div class="main">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="card">
                                  <div class="card-body">
                                      <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h4 class="mb-3">Kategorien</h4>
                                        <a href="kategorienverwaltung.php"><button class="btn btn-outline-secondary btn-sm">Alle Kategorien</button></a>
                                      </div>
                                      <table class="table table-hover mt-2">
                                          <thead>
                                              <tr>
                                                  <th>Kategorie</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php echo $kurzeListe3; ?>
                                          </tbody>
                                      </table>
                                      <?php echo $kurzeListeHinweis3; ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  <div class="main">
                      <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h4 class="mb-0">Letzte Aus-/Einbuchungen</h4>
                                        <button class="btn btn-outline-secondary btn-sm">Alle Veränderungen</button>
                                    </div>
                                    <table class="table table-hover mt-2">
                                        <thead>
                                            <tr>
                                                <th>Mitarbeiter</th>
                                                <th>Zeitpunkt</th>
                                                <th>Aktion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php echo $kurzeListe4; ?>
                                        </tbody>
                                    </table>
                                    <?php echo $kurzeListeHinweis4; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Footer START -->
                <?php include 'assets/include/footer.php' ?>
                <!-- Footer End -->
            </div>
            <!-- Content END -->

            <!-- Quick View START -->
            <div class="modal modal-right fade quick-view" id="quick-view">
                <div class="modal-dialog right">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title pull-left">Theme Config</h4>
                            <button type="button" class="close pull-right" data-bs-dismiss="modal">
                                <span>×</span>
                            </button>
                        </div>
                        <div class="modal-body scrollable">
                            <div class="mb-4">
                                <h5 class="mb-0">Header Color</h5>
                                <p>Config header background color</p>
                                <div class="theme-configurator d-flex mt-2">
                                    <div class="radio">
                                        <input id="header-default" name="header-theme" type="radio" checked value="#ffffff">
                                        <label for="header-default"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-primary" name="header-theme" type="radio" value="#11a1fd">
                                        <label for="header-primary"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-success" name="header-theme" type="radio" value="#00c569">
                                        <label for="header-success"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-info" name="header-theme" type="radio" value="#5a75f9">
                                        <label for="header-info"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-warning" name="header-theme" type="radio" value="#ffc833">
                                        <label for="header-warning"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-danger" name="header-theme" type="radio" value="#f46363">
                                        <label for="header-danger"></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="mb-0">Side Nav Dark</h5>
                                <p>Change Side Nav to dark</p>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="side-nav-theme-toggle" id="side-nav-theme-toggle">
                                    <label class="form-check-label" for="side-nav-theme-toggle"></label>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="mb-0">Folded Menu</h5>
                                <p>Toggle Folded Menu</p>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="side-nav-fold-toogle" id="side-nav-fold-toogle">
                                    <label class="form-check-label" for="side-nav-fold-toogle"></label>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Horizontal Layout</h5>
                                <p>Set Horizontal Layout</p>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary active" aria-current="page">Vertical</a>
                                    <a href="h-index.html" class="btn btn-outline-primary">Horizontal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick View END -->
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="assets/vendors/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
