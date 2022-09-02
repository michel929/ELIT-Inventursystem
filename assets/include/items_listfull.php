<?php
  // Anzahl aller Gegenstände
  $sql = "SELECT COUNT(*) FROM users";
  foreach ($pdo->query($sql) as $row) {
    $amount = (int)$row['COUNT(*)'];
  }

  $gegenstandliste = "";
  $sql = "SELECT * FROM items ORDER by name ASC"; // Alle Gegentände erhalten und nach Namen absteigend sortieren
  foreach ($pdo->query($sql) as $row) { // Folgendes für jeden Gegenstand ausführen
    // Variablen setzen
    $id = $row["id"];
    $id2 = $row["id"];
    $id = "'$id'";
    $name = $row["name"];
    $name = "'$name'";
    // Überprüfen welches Status der Gegenstand hat und dementsprechende Rückmeldung geben
    if($row["status"] == "LAGER") {
      $status = '<div class="badge-dot bg-success"></div><span class="ms-2">IM LAGER</span>';
    } else if($row["status"] == "NICHT_LAGER") {
      $owner = $row["owner"];
      $sql2 = "SELECT * FROM users WHERE id = '$owner'";
      foreach ($pdo->query($sql2) as $row2) {
        $aan = $row2["username"];
      }
      $status = '<div class="badge-dot bg-danger"></div><span class="ms-2">AUSGEHÄNDIGT an:</br><strong>' . $aan . '</strong></span>';
    } else {
      $status = '<div class="badge-dot bg-warning"></div><span class="ms-2">UNBEKANNT</span>';
    }
    #
    // Kategorie des Gegenstandes abrufen
    $itemname = $row["name"];
    $kid = $row["category"];
    $sql = "SELECT * FROM categories WHERE id='$kid'";
    foreach ($pdo->query($sql) as $row) {
      $kategorie = $row['name'];
    }
    // HTML-Table vorbereiten
    $gegenstandliste = $gegenstandliste .
    '<tr>
        <td>
            <div class="form-check mb-0">
                <input type="checkbox" class="form-check-input" name="check_list[]" value="' . $id2 . '">
            </div>
        </td>
        <td>
            <div class="d-flex align-items-center">
                <div class="ms-2">
                   <div class="text-dark fw-bold">' . $itemname . '</div>
                </div>
             </div>
        </td>
        <td>
            <span>' . $id2 . '</span>
        </td>
        <td>
            <span>' . $kategorie . '</span>
        </td>
        <td>
            <span>' . $status . '</span>
        </td>
        <td class="text-end">
            <div class="dropdown">
                <a href="#" class="px-2" data-bs-toggle="dropdown">
                    <i class="feather icon-more-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a onclick="barcode(' . $id . ',' . $name . ');" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#barcode">
                            <div class="d-flex align-items-center">
                                <i class="la-qrcode la"></i>
                                <span class="ms-2">Barcode anzeigen</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hinweis">
                            <div class="d-flex align-items-center">
                                <i class="la-box-open la"></i>
                                <span class="ms-2">Hinweis bearbeiten</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>';
  }
?>
