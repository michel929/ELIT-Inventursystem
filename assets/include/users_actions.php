<?php
  if(isset($_GET["userID"])) { $userID = $_GET["userID"]; }
  if(!isset($userID)) { $userID = ""; }

  if(isset($_GET["action"])) { $action = $_GET["action"]; }
  if(!isset($action)) { $action = ""; }

  if(isset($_GET["userID"])) {
    $sql = "SELECT * FROM users WHERE id = " . $userID . "";
    foreach ($pdo->query($sql) as $row) {
      $nname = $row["vorname"];
      $vname = $row["nachname"];
      $bname = $row["username"];
    }
  }

  $admin = $_SESSION["benutzername"];
  if($action == "ban") {
    # BAN
    $isok = sqlCMD("UPDATE `users` SET `active` = '0' WHERE `users`.`id` = " . $userID);
    if ($isok == "ok") {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-success" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) wurde gesperrt!</div></div></center>';
      teamsWebhook("## NUTZER GESPERRT:\n * Name: $vname $nname\n * UserID: $userID\n * Benutzername: $bname\n * Autorisiert von: $admin");
    } else {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-danger" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) konnte nicht gesperrt werden! Fehler: ' . $isok . '</div></div></center>';
      teamsWebhook("## SPERRUNG VON NUTZER FEHLGESCHLAGEN:\n * Name: $vname $nname\n * UserID: $userID\n * Benutzername: $bname\n * Autorisiert von: $admin\n * Fehlermeldung: $isok");
    }
  } else if($action == "unban") {
    # UNBAN
    $isok = sqlCMD("UPDATE `users` SET `active` = '1' WHERE `users`.`id` = " . $userID);
    if ($isok == "ok") {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-success" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) wurde entsperrt!</div></div></center>';
      teamsWebhook("## NUTZER ENTSPERRT:\n * Name: $vname $nname\n * UserID: $userID\n * Benutzername: $bname\n * Autorisiert von: $admin");
    } else {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-danger" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) konnte nicht entsperrt werden! Fehler: ' . $isok . '</div></div></center>';
      teamsWebhook("## ENTSPERRUNG VON NUTZER FEHLGESCHLAGEN:\n * Name: $vname $nname\n * UserID: $userID\n * Benutzername: $bname\n * Autorisiert von: $admin\n * Fehlermeldung: $isok");
    }
  } else if($action == "toadmin") {
    # PROMOTE TO ADMIN
    $isok = sqlCMD("UPDATE `users` SET `admin` = '1' WHERE `users`.`id` = " . $userID);
    if ($isok == "ok") {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-success" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) wurde hochgestuft!</div></div></center>';
      teamsWebhook("## NUTZER HOCHGESTUFT:\n * Name: $vname $nname\n * UserID: $userID\n * Benutzername: $bname\n * Autorisiert von: $admin");
    } else {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-danger" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) konnte nicht hochgestuft werden! Fehler: ' . $isok . '</div></div></center>';
      teamsWebhook("## HOCHSTUFUNG VON NUTZER FEHLGESCHLAGEN:\n * Name: $vname $nname\n * UserID: $userID\n * Benutzername: $bname\n * Autorisiert von: $admin\n * Fehlermeldung: $isok");
    }
  } else if($action == "touser") {
    # DEMOTE TO USER
    $isok = sqlCMD("UPDATE `users` SET `admin` = '0' WHERE `users`.`id` = " . $userID);
    if ($isok == "ok") {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-success" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) wurde heruntergestuft!</div></div></center>';
      teamsWebhook("## NUTZER HERUNTERGESTUFT:\n * Name: $vname $nname\n * UserID: $userID\n * Benutzername: $bname\n * Autorisiert von: $admin");
    } else {
      $erfolg = '<center><div class="col-md-10"><div class="alert alert-danger" role="alert">Der Nutzer <strong>' . $vname . ' ' . $nname . '</strong> (<strong>' . $bname .'</strong>) konnte nicht heruntergestuft werden! Fehler: ' . $isok . '</div></div></center>';
      teamsWebhook("## RUNTERSTUFUNG VON NUTZER FEHLGESCHLAGEN:\n * Name: $vname $nname\n * UserID: $userID\n * Benutzername: $bname\n * Autorisiert von: $admin\n * Fehlermeldung: $isok");
    }
  }

?>
