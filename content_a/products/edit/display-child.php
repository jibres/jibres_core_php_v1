
<form class="jPage" id='aProductData' method="post" autocomplete="off" data-refresh data-autoScroll2="#productGallery">
 <div class="row">
  <button class="hide" name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>
  <input type="hidden" name="editchild" value="editchild">
  <input type="hidden" name="havevariantchild" value="<?php if($have_variant_child){echo 1;}else{echo 0;};  ?>">

  <div class="c-xs-12 c-sm-12 c-md-8 c-xxl-9">
    <div class="box">
      <header><h2><?php echo \dash\data::productDataRow_title() ?></h2></header>
     <div class="pad">


      <div class="input">
        <label for="optionvalue1"><?php echo \dash\data::productDataRow_optionname1(); ?></label>
        <input type="text" name="optionvalue1" id="optionvalue1"  value="<?php echo \dash\get::index($productDataRow,'optionvalue1'); ?>" maxlength='200' <?php \dash\layout\autofocus::html() ?> >
      </div>

      <?php if(\dash\data::productDataRow_optionname2()) {?>
      <div class="input">
        <label for="optionvalue2"><?php echo \dash\data::productDataRow_optionname2(); ?></label>
        <input type="text" name="optionvalue2" id="optionvalue2"  value="<?php echo \dash\get::index($productDataRow,'optionvalue2'); ?>" maxlength='200'>
      </div>
    <?php } //endif ?>

    <?php if(\dash\data::productDataRow_optionname3()) {?>
      <div class="input">
        <label for="optionvalue3"><?php echo \dash\data::productDataRow_optionname3(); ?></label>
        <input type="text" name="optionvalue3" id="optionvalue3"  value="<?php echo \dash\get::index($productDataRow,'optionvalue3'); ?>" maxlength='200'>
      </div>
    <?php } //endif ?>

    </div>
  </div>


<?php
if($have_variant_child)
{
   /*  --------------- All detail for price hide when the product is parent of other product*/
}
else
{
  require_once('block/price.php');
} //endif

require_once('block/gallery.php');

if($have_variant_child)
{
  /*  --------------- All detail for inventroy hide when the product is parent of other product*/
}
else
{
  require_once('block/barcode.php');
}
require_once('block/seo.php');
?>

</div>


<div class="c-xs-12 c-sm-12 c-md-4 c-xxl-3">


<?php require_once ('block/sidebar-variant.php'); ?>

  </div>
 </div>
</form>
