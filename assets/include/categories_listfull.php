<?php
  // Anzahl aller Kategorien
  $sql = "SELECT COUNT(*) FROM users";
  foreach ($pdo->query($sql) as $row) {
    $amount = (int)$row['COUNT(*)'];
  }

  // Erstellen einer Liste, welche ein Teil eines HTML-Tables beinhaltet, die auf der richtigen Seite eingebunden wird
  $nutzerliste = "";
  $sql = "SELECT * FROM categories ORDER by name";
  foreach ($pdo->query($sql) as $row) {
    $id = $row["id"];
    $id = "'$id'";
    $kategorienliste = $kategorienliste .
    '<tr>
        <td>
            <div class="form-check mb-0">
                <input type="checkbox" class="form-check-input" name="check_list[]" value="' . $row["id"] . '">
            </div>
        </td>
        <td>
            <span>' . $row["id"] . '</span>
        </td>
        <td>
            <span>' . $row["name"] . '</span>
        </td>
    </tr>';
  }
?>
