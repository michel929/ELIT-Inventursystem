<?php
  if(isset($_POST['name'])) {
    // Filtern der Nutereingaben
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $kategorie = filter_var($_POST['kategorie'], FILTER_SANITIZE_STRING);
    $anzahl = $_POST['anzahl'];
    $isok = 0;

    if(strlen($name) <= 50) { // Zeichen des Gegenstandsnamen kürzer als 50
      if($anzahl <= 99) { // Anzahl an zu erstellenden Gegenständen weniger als 100 / größer gleich 99
        for ($x = 0; $x <= $_POST['anzahl']-1; $x++) { // Der folgende Code wird für jeden Gegenstand einzelt ausgeführt
          $id = uniqid('iC_', false); // ID erstellen

          // SQL Anfrage setzen, vorbereiten und auf Fehler testen
          $cmd = "INSERT INTO `items` (`id`, `name`, `status`, `category`, `owner`) VALUES ('$id', '$name','LAGER','$kategorie','')";
          try {
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              $pdo->prepare($cmd);
          }
          catch(Exception $e) {
              echo 'Exception -> ';
              var_dump($e->getMessage());
          }
          if (empty($e)) {
              $pdo->exec($cmd);
          }

          // Überprüfen ob der Gegenstand hinzugefügt wurde
          $sql = "SELECT * FROM items WHERE id = '$id'";
          foreach ($pdo->query($sql) as $row) {
              $isok += 1;
          }
        }
        $admin = $_SESSION["benutzername"];
        // Rückmeldung an den Nutzer, Nachricht an Teams und Protokoll
        if ($isok == $_POST['anzahl']) {
          $erfolg = '<center><div class="col-md-10"><div class="alert alert-success" role="alert">Der Gegenstand <strong>' . $name . '</strong> wurde in der Kategorie <strong>' . $kategorie . '</strong> erstellt!</div></div></center>';
          teamsWebhook("## NEUER GEGENSTAND HINZUGEFÜGT:\n * Bezeichnung: $name\n * Kategorie: $kategorie\n * Anzahl: $anzahl\n * Autorisiert von: $admin");
          $log = "GEGENSTAND HINZUGEFÜGT: $name || Kategorie: $kategorie || Anzahl: $anzahl ||  Autorisiert von: $admin";
          logger($benutzername, $log);
        } else {
          $erfolg = '<center><div class="col-md-10"><div class="alert alert-danger" role="alert">Der Gegenstand <strong>' . $name . '</strong> wurde in der Kategorie <strong>' . $kategorie . '</strong> konnte nicht erstellt werden! Fehler: ' . $e . '</div></div></center>';
          teamsWebhook("## HINZUFÜGEN VON GEGENSTAND FEHLGESCHLAGEN:\n * Bezeichnung: $vname\n * Kategorie: $kategorie\n * Anzahl: $anzahl\n * Autorisiert von: $admin\n * Fehlermeldung: $e");
          $log = "FEHLERHAFT GEGENSTAND HINZUGEFÜGT: $name || Kategorie: $kategorie || Anzahl: $anzahl ||  Autorisiert von: $admin";
          logger($benutzername, $log);
        }
      }
    }
  }
?>
