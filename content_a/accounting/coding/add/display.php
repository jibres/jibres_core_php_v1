<?php
if(\dash\data::myType() || \dash\data::editMode())
{
  require_once('display-add.php');
}
else
{
  require_once('display-choose.php');
}
?>