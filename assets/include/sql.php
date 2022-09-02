<?php
  // Einer der wichtigsten, wenn nicht die wichtigste Datei
  // Verbindung zur Datenbank aufbauen
  $pdo = new PDO('mysql:host=main-mariadb:3306;dbname=inventursystem', 'inventursystem', '0HwfvAu8)@445Ffm');

  // Funktion zum ausführen von SQL Befehlen
  function sqlCMD($cmd) {
    try {
        global $pdo;
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
      return "ok";
    } else {
      return $e;
    }
  }
?>
