<?php
  include 'assets/include/logger.php';

  // Funktion, um mögliche Nutzeranmeldungen zu überprüfen
  function nutzerAnmelden($id) {
    // Nutzer in der Datenbank suchen und den Vornamen und Benutzernamen als Variable setzen
    $sql = "SELECT * FROM users WHERE id = '$id'";
    global $pdo;
    foreach ($pdo->query($sql) as $row) {
      $vorname = $row["vorname"];
      $benutzername = $row["username"];
    }
    // Damit die Variablen außerhalb der Funktion genutzt werden können, müssen diese als global markiert werden
    global $scan;
    global $button;
    global $locked;
    if($row["active"] == 0) {
      // Falls der Nutzer gesperrt wurde, also Aktiv == 0 so wird eine Meldung angezeigt
      $scan = "Hallo <strong>" . $vorname . "</strong>!</br><a style='color:red;'>Dein Account wurde gesperrt, du kannst keine Gegenstände verbuchen.</a>";
      $button = "<a href='scan.php?id=destroy'><button type='button' class='btn btn-primary btn-sm'>Zum Abmelden den Ausweis erneut scannen</button></a>";
      $locked = "";
      session_unset(); // Zerstörung der Sitzung
      session_destroy();
      $log = "GESPERRTER NUTZER ANMELDUNG";
      logger($benutzername, $log); // Loggen
    } else {
    // Falls der Nutzer nicht gesperrt ist, werden nun die Cookies gesetzt
    $_SESSION["scanuserID"] = $id;
    $_SESSION["vorname"] = $vorname;
    $_SESSION["benutzername"] = $benutzername;
    // Rückmeldung an den Nutzer
    $scan = "Hallo <strong>" . $vorname . "</strong>!</br>Du kannst nun Gegestände zum Buchen einscannen.";
    $button = "<a href='scan.php?id=destroy'><button type='button' class='btn btn-primary btn-sm'>Zum Abmelden den Ausweis erneut scannen</button></a>";
    $locked = "";
    $log = "NUTZER ANMELDUNG";
    logger($benutzername, $log); // loggen
  }

  // Funktion, um mögliche Gegenstandsbuchungen zu verwalten
  function gegenstandBuchen($id) {
    // Damit die Variablen außerhalb der Funktion genutzt werden können, müssen diese als global markiert werden
    global $scan;
    global $button;
    global $locked;
    if(isset($_SESSION["scanuserID"])) { // Falls der Nutzer eingeloggt ist (Überprüfung mit Hilfe der beim anmelden gesetzten Cookies)
      $userID = $_SESSION["scanuserID"];
      global $vorname;

      // Status des gebuchten Gegenstands bekommen
      $sql = "SELECT * FROM items WHERE id = '$id'";
      global $pdo;
      foreach ($pdo->query($sql) as $row) {
        $status = $row["status"];
      }

      if($status == "NICHT_LAGER") {
        // Falls der Gegenstand ausgebucht war, wird er nun eingebucht
        $type = "eingebucht";
        $st = sqlCMD("UPDATE `items` SET `status` = 'LAGER', `owner` = '' WHERE `items`.`id` = '$id';");
      } else if($status == "LAGER") {
        // Falls der Gegenstand eingebucht war, wird er nun ausgebucht
        $type = "ausgebucht";
        $st = sqlCMD("UPDATE `items` SET `status` = 'NICHT_LAGER', `owner` = '$userID' WHERE `items`.`id` = '$id';");
      }

      if($st == "ok") {
        // Falls die Buchung erfolgreich war, wird dies dem Nutzer angezeigt, an Teams gesendet und protokolliert
        $scan = "Gegenstand &quot<strong>" . $id . "</strong>&quot als <strong>" . $_SESSION["benutzername"]  . "</strong> " . $type . ".";
        $button = "<a href='scan.php?id=destroy'><button type='button' class='btn btn-primary btn-sm'>Zum Abmelden den Ausweis erneut scannen</button></a>";
        $locked = "";
        teamsWebhook("## GEGENSTAND " . strtoupper($type) . ":\n * Gegenstand: $id\n * Benutzername: " . $_SESSION["benutzername"]);
        $log = "GEGENSTAND " . strtoupper($type) . ": " . $id;
        logger($_SESSION["benutzername"], $log);
      } else {
        // Falls die Buchung nicht erfolgreich war, wird dies dem Nutzer angezeigt und zur weiteren Fehlerbehebung an Teams gesendet und protokolliert
        $scan = "<a style='color:red;'>FEHLER</a>: Gegenstand &quot<strong>" . $id . "</strong>&quot konnte als <strong>" . $_SESSION["benutzername"]  . "</strong> nicht" . $type . " werden!";
        $button = "<a href='scan.php?id=destroy'><button type='button' class='btn btn-primary btn-sm'>Zum Abmelden den Ausweis erneut scannen</button></a>";
        $locked = "";
        teamsWebhook("## FEHLER: GEGENSTAND " . strtoupper($type) . ":\n * Gegenstand: $id\n * Benutzername: " . $_SESSION["benutzername"] . "\n * Fehlermeldung: $st");
        $log = "FEHLER BEIM GEGENSTAND " . strtoupper($type) . ": " . $id . " || Fehlermeldung: " . $st;
        logger($_SESSION["benutzername"], $log);
      }
    } else {
      // Falls der Nutzer nicht angemeldet war, wird er aufgefordert sich erneut anzumelden
      $scan = "Fehler bei der Anmeldung, bitte Zum Abmelden den Ausweis erneut scannen.";
      $button = "<a href='scan.php?id=destroy'><button type='button' class='btn btn-primary btn-sm'>Zum Abmelden den Ausweis erneut scannen</button></a>";
      $locked = "disabled";
    }
  }

  if (empty($_GET["id"])) {
    // Falls keine oder eine Fehlerhafte GET Anfrage gestellt wurde, wird der Nutzer aufgefordert sich anzumelden
    $id = 0;
    $scan = "Bitte Barcode auf dem Ausweis scannen.";
    $button = "";
    $locked = "";
  } else {
    $id = str_replace('?', '_', $_GET["id"]); // Aufgrund eines Fehlers mit dem Barcode Scanner, muss das Fragezeichen mit einem Unterstrich ersetzt werden
    if(str_starts_with($id, "uC_")) { // Falls die ID mit "uC_" (userCode) beginnt, weiß das System das es sich um eine Anmeldung handelt
      if(isset($_SESSION["scanuserID"])) { // Überprüfung ob der Nutzer bereits angemeldet ist
        if($_SESSION["scanuserID"] == $id) { // Überprüfung ob der bereits angemeldete Nutzer der neue Nutzer ist
          // Falls der selbe Nutzer also nach seiner Anmeldung noch einmal seinen Barcode scannt so wird dieser abgemeldet
          $scan = "Bitte Barcode auf dem Ausweis scannen.";
          $button = "";
          $locked = "";
          $benutzername = $_SESSION["benutzername"];
          session_unset();
          session_destroy();
          logger($benutzername, "NUTZER ABMELDUNG");
          return false;
        }
      }
      nutzerAnmelden($id); // Sollte es ein anderer Nutzer sein, so wird dieser angemeldet
    } else if(str_starts_with($id, "iC_")) { // Sollte die ID mit "iC_" (itemCode) starten, so handelt es sich um ein Item
      gegenstandBuchen($id); // Aufrufen der gegenstandBuchen Funktion mit der betreffenden ID
    } else if($id == "destroy") { // Administrative Funktion: Nutzer wird sofort angemeldet und die Sitzung zerstört.
      $scan = "Bitte Barcode auf dem Ausweis scannen.";
      $button = "";
      $locked = "";
      session_unset();
      session_destroy();
    } else if($id == "reload") { // Administrative Funktion: Die Seite wird neu gelanden, um z. B. Updates einzuspielen
      $scan = "Bitte Barcode auf dem Ausweis scannen.";
      $button = "";
      $locked = "";
      session_unset();
      session_destroy();
      echo("<script>window.location.replace('http://192.168.178.123:2020/scan.php');</script>"); // Neu laden der Seite mittels Javascript
    } else { // Falls der Code weder ein user- noch itemCode ist, so wird eine Fehlermeldung ausgegeben
      // Aus Sicherheitsgründen wird die Sitzung zerstört und das ganze protokolliert
      $scan = "Ein Fehler ist aufgetreten.</br>Der Code (" . $id . ") konnte nicht zugeordnet werden.</br>Bitte scanne deinen Ausweis erneut.";
      $button = "";
      $locked = "";
      session_unset();
      session_destroy();
      $log = "FEHLERHAFTER CODE: " . $id;
      logger($benutzername, $log);
    }
  }
?>
