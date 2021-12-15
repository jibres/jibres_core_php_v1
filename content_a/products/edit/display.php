<?php

$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child =\dash\data::productDataRow_variant_child();
$child_list         = \dash\data::productDataRow_child();

if(!is_array($child_list))
{
	$child_list = [];
}

?>
<form class="jPage" id='aProductData' method="post" autocomplete="off" data-autoScroll2="#productGallery">
  <div class="row">
    <button class="hide" name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>
    <input type="hidden" name="havevariantchild" value="<?php if($have_variant_child){echo 1;}else{echo 0;};  ?>">
    <div class="c-xs-12 c-sm-12 c-md-8 c-xxl-9">
<?php
require_once('block/title.php');
require_once('block/price.php');
require_once('block/category.php');
require_once('block/desc.php');
require_once('block/gallery.php');
if($have_variant_child)
{
/*  --------------- All detail for inventory hide when the product is parent of other product*/
}
else
{
  require_once('block/barcode.php');
}

if(\dash\data::productDataRow_parent())
{
  require_once('block/inventory-child.php');
}
else
{
  require_once('block/inventory-master.php');
}


if(\dash\data::editMode())
{
  require_once('block/seo.php');
}

?>
    </div>
    <div class="c-xs-12 c-sm-12 c-md-4 c-xxl-3">
      <?php require_once ('block/sidebar-menu.php'); ?>
    </div>
  </div>
</form>

<?php if(\dash\url::child() !== 'add') {?>

<div class="btn-outline-secondary text-sm" data-confirm data-data='{"archive": "product"}'><?php echo T_("Archive product") ?></div>
<div class="btn-outline-danger text-sm" data-confirm data-data='{"delete": "product"}'><?php echo T_("Delete product") ?></div>
<?php } //endif ?>