<?php

$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child =\dash\data::productDataRow_variant_child();
$child_list         = \dash\data::productDataRow_child();

if(!is_array($child_list))
{
	$child_list = [];
}

require_once('display-master.php');
?>