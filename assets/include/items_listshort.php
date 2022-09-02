<?php
  // Anzahl an Gegenständen
  $sql = "SELECT COUNT(*) FROM items";
  foreach ($pdo->query($sql) as $row) {
    $amount = (int)$row['COUNT(*)'];
  }

  // Alle Gegentände erhalten und nach Namen absteigend sortieren, max. fünf
  $kurzeListe = "";
  $sql = "SELECT * FROM items LIMIT 5";
  foreach ($pdo->query($sql) as $row) {
    // Status für die Rückmeldung abrufen
    if($row["status"] == "LAGER") {
      $status = '<div class="badge-dot bg-success"></div><span class="ms-2">IM LAGER</span>';
    } else if($row["status"] == "NICHT_LAGER") {
      $status = '<div class="badge-dot bg-danger"></div><span class="ms-2">AUSGEHÄNDIGT</span>';
    } else {
      $status = '<div class="badge-dot bg-warning"></div><span class="ms-2">UNBEKANNT</span>';
    }
    // HTML-Table
    $kurzeListe = $kurzeListe .
    '<tr class="cursor-pointer">
        <td>
          <div class="d-flex align-items-center">
            <div class="ms-2">
              <div class="fw-bolder text-dark">' . $row["name"] . '</div>
              <div class="text-muted fw-semibold">ID: ' . $row["id"] . '</div>
            </div>
          </div>
        </td>
        <td>
            ' . $status . '
        </td>
    </tr>';
  }
  // Falls es mehr als fünf Gegenstände gibt, Hinweis anzeigen
  $kurzeListeHinweis = "";
  if($amount > 5) {
    $kurzeListeHinweis = "Und <a href='gegenstandverwaltung.php'>" . $amount - 5 . " weitere</a> Gegenstände...";
  }
?>
