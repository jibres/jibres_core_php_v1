<?php

$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child =\dash\data::productDataRow_variant_child();
$child_list         = \dash\data::productDataRow_child();

if(!is_array($child_list))
{
	$child_list = [];
}

if(\dash\data::productDataRow_parent())
{
  require_once('display-child.php');
}
else
{
  require_once('display-master.php');

}
?>
