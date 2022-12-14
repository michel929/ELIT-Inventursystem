<?php session_start(); ?>
<?php if(!isset($_SESSION["userID"])) { header('Location: /login.php'); die; } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ELIT Inventur - Gegenstandverwaltung</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.ico">

    <!-- page css -->
    <link href="assets/vendors/apexcharts/dist/apexcharts.css" rel="stylesheet">

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">

    <!-- QRCode Generator -->
    <script src="assets/js/JsBarcode.all.min.js"></script>

    <!--- PHP Includes -->
    <?php include 'assets/include/teams_connector.php' ?>
    <?php include 'assets/include/sql.php' ?>
    <?php include 'assets/include/items_listfull.php' ?>
    <?php include 'assets/include/items_createitem.php' ?>
    <?php include 'assets/include/categories_listshort.php' ?>
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
                <?php if(!isset($erfolg)) { $erfolg = ""; } else { echo "</br>" . $erfolg; } ?>
                <!-- Modal -->
                <div class="modal fade" id="barcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Barcode</h5>
                                <button type="button" onclick="document.getElementById('barcode').innerHTML = ''; " class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <center><img id="barcode" width="450px" /></center>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="document.getElementById('barcode').innerHTML = ''; ">Passt!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="hinweis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hinweis bearbeiten</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                xyz
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Passt!</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main">
                    <div class="page-header">
                        <h4 class="page-title">Gegenstand anlegen</h4>
                    </div>
                    <form class="row g-3" method="POST" action="gegenstandverwaltung.php">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Bezeichnung</label>
                            <input type="text" class="form-control" id="inputEmail4" name="name" minlength="1" maxlength="50" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Kategorie</label>
                            <select id="inputState" class="form-select" name="kategorie">
                                <?php echo $dropDownListe; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Anzahl</label>
                            <input type="number" class="form-control" id="inputEmail4" name="anzahl" min="1" max="99" value="1" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Gegenstand erstellen</button>
                        </div>
                    </form>
                    </br></br></br></br></br>
                    <div class="card">
                      <form action="export_items.php" method="post">
                          <div class="card-body">
                              <div class="d-flex align-items-center justify-content-between mb-4">
                                <h4 class="mb-3">Gegenstandsliste</h4>
                                <label for="size">Labelgr????e:</label>
                                <select name="size" id="size" required>
                                  <option value="small">Klein ()</option>
                                  <option value="medium">Mittel (57,7 mm x 21,3 mm)</option>
                                  <option value="large">Gro?? ()</option>
                                </select>
                                <button class="btn btn-outline-secondary btn-sm" value="large" type="submit">Exportieren</button>
                              </div>
                              <div>
                                  <table class="table table-hover user-list-table">
                                      <thead>
                                          <tr>
                                              <th>
                                                  <div class="form-check mb-0">
                                                      <input type="checkbox" class="form-check-input" onclick="toggle(this)">
                                                  </div>
                                              </th>
                                              <th>Bezeichnung</th>
                                              <th>ScanCodeID</th>
                                              <th>Kategorie</th>
                                              <th>Status</th>
                                              <th></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php if(isset($gegenstandliste)) {echo $gegenstandliste;} ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                        </form>
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
                                <span>??</span>
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
                            <hr>
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
    <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/pages/user-list.js"></script>

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>

    <!-- Formulardaten entfernen -->
    <script type='text/javascript'> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href );}</script>

    <!-- Barcode Generator -->
    <script type="text/javascript">
      function barcode(itemID, name) {
        JsBarcode("#barcode", itemID, {
          textmargin: -2,
          height: 50,
          fontsize: 13,
          text: name
        });
      }

    function toggle(source) {
      checkboxes = document.getElementsByName('check_list[]');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
      }
    }
    </script>

</body>

</html>
