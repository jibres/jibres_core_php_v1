<?php
$myFooterFile = \dash\layout\func::display_addr(). '-footer.php';
if(is_file($myFooterFile))
{
  require_once $myFooterFile;
}
?>