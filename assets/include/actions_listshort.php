<?php
  // MUSS NOCH ABGEÄNDERT WERDEN!!
  // MUSS NOCH ABGEÄNDERT WERDEN!!
  // MUSS NOCH ABGEÄNDERT WERDEN!!

  // Der folgende Code nimmt sich die letzten fünf Nutzer aus der Datenbank
  $kurzeListe4 = "";
  $sql = "SELECT * FROM users LIMIT 5";

  // Jeder der fünf Nutzer wird nur in einer Schleife einzelt bearbeitet, je nach Zustand
  foreach ($pdo->query($sql) as $row) {
    $row["aktion"] = "IN_LAGER";
    if($row["aktion"] == "IN_LAGER") {
      $aktion = '<div class="badge-dot bg-success"></div><span class="ms-2">EINLAGERUNG von:</br><strong>ARTIKELNAME XYZ</strong></span>';
    } else if($row["aktion"] == "AUS_LAGER") {
      $aktion = '<div class="badge-dot bg-danger"></div><span class="ms-2">AUSLAGERUNG von:</br><strong>ARTIKELNAME XYZ</strong></span>';
    } else {
      $aktion = '<div class="badge-dot bg-warning"></div><span class="ms-2">UNBEKANNT</span>';
    }
    $kurzeListe4 = $kurzeListe4 .
    '<tr class="cursor-pointer">
        <td>
            <div class="d-flex align-items-center">
                <div class="avatar avatar-circle avatar-image" style="width: 35px; height: 35px;">
                    <img src="' . $row["ppurl"] . '">
                </div>
                <div class="ms-2">
                    <div class="fw-bolder text-dark">' . $row["vorname"] . ' ' . $row["nachname"] . '</div>
                    <div class="text-muted fw-semibold"><small>' . $row["id"] . '</small></div>
                </div>
            </div>
        </td>
        <td>16.05.2022 10:10</td>
        <td>' . $aktion . '</td>
    </tr>';
  }
  $kurzeListeHinweis4 = "";
  if($amount > 5) {
    $kurzeListeHinweis4 = "Und <a href='nutzerverwaltung.php'>" . $amount - 5 . " weitere</a> Nutzer...";
  }
?>
