<?php
  $file = fopen('.reboot-server',"w");
  fwrite($file, 'reboot');
  close($file);
?>
