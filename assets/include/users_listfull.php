<?php
  $sql = "SELECT COUNT(*) FROM users";
  foreach ($pdo->query($sql) as $row) {
    $amount = (int)$row['COUNT(*)'];
  }

  $nutzerliste = "";
  $sql = "SELECT * FROM users ORDER by nachname ASC, vorname";
  foreach ($pdo->query($sql) as $row) {
    $id = $row["id"];
    $id = "'$id'";
    $username = $row["username"];
    $username = "'$username'";
    if($row["admin"] == 1) {
      $gruppe = "Administrator";
      $group_text = "Zu Benutzer herunterstufen";
      $group_link = "nutzerverwaltung.php?userID=$id&action=touser";
      $group_icon = "minus";
    } else {
      $gruppe = "Benutzer";
      $group_text = "Zu Administrator hochstufen";
      $group_link = "nutzerverwaltung.php?userID=$id&action=toadmin";
      $group_icon = "plus";
    }
    if($row["active"] == 1) {
      $status = '<div class="badge-dot bg-success"></div><span class="ms-2">AKTIV</span>';
      $lock_icon = "lock";
      $lock_link = "nutzerverwaltung.php?userID=$id&action=ban";
      $lock_text = "Benutzer sperren";
    } else {
      $status = '<div class="badge-dot bg-danger"></div><span class="ms-2">GESPERRT</span>';
      $lock_icon = "unlock";
      $lock_link = "nutzerverwaltung.php?userID=$id&action=unban";
      $lock_text = "Benutzer entsperren";
    }
    $nutzerliste = $nutzerliste .
    '<tr>
        <td>
            <div class="form-check mb-0">
                <input type="checkbox" class="form-check-input" name="check_list[]" value="' . $row["id"] . '">
            </div>
        </td>
        <td>
            <div class="d-flex align-items-center">
                <div class="avatar avatar-circle avatar-image" style="width: 38px; height: 38px;">
                   <img src="' . $row["ppurl"] . '" alt="">
                </div>
                <div class="ms-2">
                   <div class="text-dark fw-bold">' . $row["vorname"] . ' ' . $row["nachname"] . '</div>
                </div>
             </div>
        </td>
        <td>
            <span>' . $row["username"] . '</span>
        </td>
        <td>
            <span>' . $row["id"] . '</span>
        </td>
        <td>
            <span>' . $gruppe . '</span>
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
                        <a href="' . $group_link . '" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <i class="feather icon-user-' . $group_icon . '"></i>
                                <span class="ms-2">' . $group_text . '</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="' . $lock_link . '" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <i class="feather icon-' . $lock_icon . '"></i>
                                <span class="ms-2">' . $lock_text . '</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="barcode(' . $id . ',' . $username . ');" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="d-flex align-items-center">
                                <i class="la-qrcode la"></i>
                                <span class="ms-2">Barcode anzeigen</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>';
  }
?>
