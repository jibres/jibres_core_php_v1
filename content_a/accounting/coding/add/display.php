<?php
if(\dash\data::myType())
{
  require_once('display-add.php');
}
else
{
  require_once('display-choose.php');
}
?>