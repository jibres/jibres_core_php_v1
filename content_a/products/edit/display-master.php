
<form class="jPage" id='aProductData' method="post" autocomplete="off" data-autoScroll2="#productGallery">
 <div class="row">
  <button class="hide" name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>
  <input type="hidden" name="havevariantchild" value="<?php if($have_variant_child){echo 1;}else{echo 0;};  ?>">
  <div class="c-xs-12 c-sm-12 c-md-8 c-xxl-9">
    <div class="box">
     <div class="pad">

      <div class="input">
        <input type="text" name="title" id="title" placeholder='<?php echo T_("Product Title"); ?> *' value="<?php echo a($productDataRow,'title'); ?>" maxlength='200' <?php \dash\layout\autofocus::html() ?> <?php if(\dash\data::productDataRow_parent()) { echo 'disabled';} ?>>
        <span class="addon small" data-kerkere='.subTitle' <?php if(\dash\data::productDataRow_title2()) {?> data-kerkere-icon='open' <?php }else{ ?> data-kerkere-icon='close' <?php }//endif ?>><?php echo T_("Technical title"); ?></span>
      </div>
      <div class="subTitle" data-kerkere-content='<?php if(\dash\data::productDataRow_title2()) {echo 'show'; }else{ echo 'hide'; } ?>'>
        <div class="input mT10 ltr">
          <input type="text" name="title2" id="title2" placeholder='Technical Title' value="<?php echo \dash\data::productDataRow_title2(); ?>" maxlength='300' minlength="1" pattern=".{1,300}">
        </div>
      </div>
     </div>
    </div>
      <?php require_once('block/price.php'); ?>
    <?php if(!\dash\detect\device::detectPWA()) {?>
    <div class="box">
      <div class="pad ovv">
        <textarea name="html" data-editor class="txt" rows="3" maxlength="2000" placeholder='<?php echo T_("Description about product"); ?>'><?php echo a(\dash\data::productDataRow(),'desc'); ?></textarea>
      </div>
    </div>
    <?php  } //endif ?>

      <?php require_once('block/gallery.php'); ?>
    <?php if($have_variant_child) {?>
      <?php /*  --------------- All detail for inventroy hide when the product is parent of other product*/ ?>
    <?php }else{ ?>
      <?php require_once('block/barcode.php'); ?>

<?php } //endif ?>
<?php if(\dash\data::editMode()) {?>
    <?php require_once('block/seo.php'); ?>
<?php } //endif ?>




</div>


<div class="c-xs-12 c-sm-12 c-md-4 c-xxl-3">
  <div class="box">
    <div class="pad">
      <div class="mB10">
        <div class="row align-center">
          <div class="c"><label for='tag'><?php echo T_("Tag"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/tag"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>
        <select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">
          <?php foreach (\dash\data::listCategory() as $key => $value) {?>
            <option value="<?php echo $value['title']; ?>" <?php if(is_array(\dash\data::listSavedCat()) && in_array($value['title'], \dash\data::listSavedCat())) {echo 'selected'; } ?>><?php echo $value['title']; ?></option>
          <?php } //endfor ?>
        </select>
      </div>
    </div>
  </div>





<?php require_once ('block/sidebar-menu.php'); ?>

  </div>
 </div>
</form>
