<?php
  // Anzahl an Nutzern
  $sql = "SELECT COUNT(*) FROM users";
  foreach ($pdo->query($sql) as $row) {
    $amount = (int)$row['COUNT(*)'];
  }

  // Alle Nutzer erhalten, max. fünf
  $kurzeListe2 = "";
  $sql = "SELECT * FROM users LIMIT 5";
  foreach ($pdo->query($sql) as $row) {
    // HTML-Table
    $kurzeListe2 = $kurzeListe2 .
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
    </tr>';
  }
  // Falls es mehr als fünf Nutzer gibt, Hinweis anzeigen
  $kurzeListeHinweis2 = "";
  if($amount > 5) {
    $kurzeListeHinweis2 = "Und <a href='nutzerverwaltung.php'>" . $amount - 2 . " weitere</a> Nutzer...";
  }
?>
