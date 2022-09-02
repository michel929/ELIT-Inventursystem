<?php
  function logger($user, $action) {
    global $pdo; // Zugriff auf das globale PDO System

    $timestamp = time(); // Aktueller Zeitstempel

    // SQL Befehl vorbereiten und auf Fehler überprüfen
    $cmd = "INSERT INTO `log` (`timestamp`, `user`, `action`) VALUES ('$timestamp', '$user', '$action')";
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
  }
?>
