<?php
require_once(root. 'content_a/products/productName.php');
if(\dash\data::productDataRow_parent())
{
  require_once('display-child.php');
}
else
{
  require_once('display-master.php');
}

?>

