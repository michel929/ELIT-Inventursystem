<?php session_start(); ?>
<?php if(!isset($_SESSION["userID"])) { header('Location: /login.php'); die; } ?>

<?php

  $number = 0;
  $barcode = "";
  $firstValue = true;

  function barCode() {
    global $barcode;
    global $number;
    global $firstValue;
    global $_POST;

    if($firstValue == true) {
      $number = 0;
      $firstValue = false;
    } else {
      $number += 1;
    }

    if(isset($_POST['check_list'][$number])) {
      $value = $_POST['check_list'][$number];
      $barcode = '<svg class="barcode" jsbarcode-value="' . $value . '" jsbarcode-textmargin="-1" jsbarcode-fontsize="8" jsbarcode-width=1 jsbarcode-height=15 />';
      return $barcode;
    }
  }

  if($_POST["size"] == "small") {
    include 'assets/include/export_layout_small.php';
  } else if($_POST["size"] == "medium") {
    include 'assets/include/export_layout_medium.php';
  } else if($_POST["size"] == "large") {
    include 'assets/include/export_layout_large.php';
  }

?>

<script type="text/javascript">
  JsBarcode(".barcode").init();
</script>
