<?php
if(\dash\url::dir(3) === 'add' || \dash\url::dir(3) === 'edit')
{
  require_once('display-add.php');
}
elseif(\dash\url::dir(3) === 'set')
{
  require_once('display-set.php');
}
else
{
  require_once('display-slider.php');
}
?>
