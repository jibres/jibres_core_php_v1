<?php
if(\dash\data::productDataRow_parent())
{
  require_once('display-child.php');
}
else
{
  require_once('display-master.php');
}

?>