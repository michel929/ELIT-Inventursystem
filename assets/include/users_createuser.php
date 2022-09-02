<?php
  if(isset($_POST['vorname'])) {
    $vname = filter_var($_POST['vorname'], FILTER_SANITIZE_STRING);
    $nname = filter_var($_POST['nachname'], FILTER_SANITIZE_STRING);
    $bname = strtolower($vname . '.' . $nname . '_' . rand(1000, 9999));
    $gruppe = filter_var($_POST['rolle'], FILTER_SANITIZE_STRING);

    if($gruppe == "Administrator") {
      $admin = 1;
    } else {
      $admin = 0;
    }

    $id = uniqid('uC_', false);

    $cmd = "INSERT INTO `users` (`id`, `ppurl`, `vorname`, `nachname`, `username`, `admin`) VALUES ('$id', 'http://192.168.178.123:2020/assets/images/avatars/default.png', '$vname','$nname','$bname','$admin')";
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

    $sql = "SELECT * FROM users WHERE id = '$id'";
    foreach ($pdo->query($sql) as $row) {
        $isok = "ok";
    }

    $admin = $_SESSION["benutzername"];
    if ($isok == "ok") {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-success" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) wurde mit der Gruppe <strong>' . $gruppe . '</strong> erstellt!</div></div></center>';
      teamsWebhook("## NEUER NUTZER ANGELEGT:\n * Name: $vname $nname\n * Benutzername: $bname\n * Gruppe: $gruppe\n * Autorisiert von: $admin");
    } else {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-danger" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) wurde mit der Gruppe <strong>' . $gruppe . '</strong> konnte nicht erstellt werden! Fehler: ' . $e . '</div></div></center>';
      teamsWebhook("## ANLEGEN VON NUTZER FEHLGESCHLAGEN:\n * Name: $vname $nname\n * Benutzername: $bname\n * Autorisiert von: $admin\n * Fehlermeldung: $e");
    }
  }
?>
