<?php
$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child =\dash\data::productDataRow_variant_child();

if(\dash\data::productDataRow_parent())
{
  require_once('display-child.php');
}
else
{
  require_once('display-master.php');

}
?>
