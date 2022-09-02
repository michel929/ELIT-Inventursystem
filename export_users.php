<?php session_start(); ?>
<?php if(!isset($_SESSION["userID"])) { header('Location: /login.php'); die; } ?>

<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 15 (filtered)">
<script src="assets/js/JsBarcode.all.min.js"></script>
<style>
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;}
@page WordSection1
	{size:21.0cm 841.95pt;
	margin:24.95pt 7.05pt 10.8pt 5.1pt;}
div.WordSection1
	{page:WordSection1;}
</style>

</head>

<body lang=DE>

<div class=WordSection1>

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
?>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse'>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
 <tr style='height:72.0pt'>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:198.4pt;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
  <td width=265 style='width:7.0cm;padding:0cm 3.5pt 0cm 3.5pt;height:72.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo barcode(); ?></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-size:1.0pt'>&nbsp;</span></p>

</div>
</body
</html>

<script type="text/javascript">
  JsBarcode(".barcode").init();
</script>
