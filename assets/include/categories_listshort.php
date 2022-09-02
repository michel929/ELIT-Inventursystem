<?php
  // Anzahl aller Kategorien
  $sql = "SELECT COUNT(*) FROM categories";
  foreach ($pdo->query($sql) as $row) {
    $amount = (int)$row['COUNT(*)'];
  }

    // Erstellen einer Liste mit den letzten fünf Kategorien, welche ein Teil eines HTML-Tables beinhaltet, die auf dem Dashboard eingebunden wird
  $kurzeListe3 = "";
  $sql = "SELECT * FROM categories LIMIT 5";
  foreach ($pdo->query($sql) as $row) {
    $kurzeListe3 = $kurzeListe3 .
    '<tr class="cursor-pointer">
        <td>' . $row["id"] . '</td>
        <td>' . $row["name"] . '</td>
    </tr>';
  }

  // Verwaltung des DropDown Menüs für das Erstellen eines Gegenstandes (Kategorienauswahl)
  $dropDownListe = "";
  $sql = "SELECT * FROM categories";
  foreach ($pdo->query($sql) as $row) {
    $dropDownListe = $dropDownListe .
    '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
  }

  // Hinweis, sollten mehr als fünf Gegenstände vorhanden sein
  $kurzeListeHinweis3 = "";
  if($amount > 5) {
    $kurzeListeHinweis3 = "Und <a href='kategorienverwaltung.php'>" . $amount - 5 . " weitere</a> Kategorien...";
  }
?>
