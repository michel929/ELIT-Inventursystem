<?php
  if(isset($_POST['bezeichnung'])) { // Falls ein POST-Request mit der 'bezeichnung' Information empfangen wird
    $bezeichnung = filter_var($_POST['bezeichnung'], FILTER_SANITIZE_STRING); // Setze die Variable auf die "bereinige" Eingabe des Nutzers -> Schutz vor SQLInjections, ...

    $id = uniqid('kC_', false); // Erstellen einer kurzen("false") eindeutigen ID mit dem Präfix "kC_" (kategorieCode)

    $cmd = "INSERT INTO `categories` (`id`, `name`) VALUES ('$id', '$bezeichnung')"; // SQL Befehl um die Kategorie zu erstellen / Datenbankeintrag schreiben
    try { // try = versuche
        // Aktivierung des Fehlermodes = Fehler werden angezeigt
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->prepare($cmd);
    }
    // Falls ein Fehler während der Ausführung auftreten sollte, so wird dieser hier ausgegeben
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
    if (empty($e)) { // Falls die Fehlervariable $e leer ist, führe den Befehl aus
        $pdo->exec($cmd);
    }

    // Aus Sicherheitsgründen noch ein mal nach der eben erstellen Kategorie suchen
    $sql = "SELECT * FROM categories WHERE id = '$id'";
    foreach ($pdo->query($sql) as $row) {
        $isok = "ok"; // Falls die eben erstelle Kategorie mit der ID gefunden wurden, so ist alles okay
    }

    $admin = $_SESSION["benutzername"];
    if ($isok == "ok") {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-success" role="alert">Die Kategorie <strong>' . $bezeichnung . '</strong> wurde erstellt!</div></div></center>'; // Ausgabe für den Nutzer auf der Seite
      teamsWebhook("## NEUE KATEGORIE ANGELEGT:\n * Bezeichnung: $bezeichnung\n * Autorisiert von: $admin"); // Benachrichtung an den Teams Webhook
      $log = "ANLEGEN KATEGORIE: " . $id . " (" . $bezeichnung . ")";
      logger($benutzername, $log); // Das ganze an die Log Funktion senden
    } else {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-danger" role="alert">Die Kategorie <strong>' . $bezeichnung . '</strong> konnte nicht erstellt werden! Fehler: ' . $e . '</div></div></center>';
      teamsWebhook("## ANLEGEN VON KATEGORIE FEHLGESCHLAGEN:\n * Bezeichnung: $bezeichnung\n * Autorisiert von: $admin\n * Fehlermeldung: $e");
      $log = "FEHLER ANLEGEN KATEGORIE: " . $id . " (" . $bezeichnung . ")" . " || Fehlermeldung: " . $e;
      logger($benutzername, $log);
    }
  }
?>
