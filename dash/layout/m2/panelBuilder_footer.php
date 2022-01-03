<?php

$footerFile = \dash\layout\func::display_addr(). '-footer.php';
if(is_file($footerFile))
{
  require_once $footerFile;
}

?>