<div class="box">
  <div class="pad">
     <div class="input">
      <input type="text" name="title" id="title" placeholder='<?php echo T_("Product Title"); ?> *' value="<?php echo a($productDataRow,'title'); ?>" maxlength='200' <?php \dash\layout\autofocus::html() ?> <?php if(\dash\data::productDataRow_parent()) { echo 'disabled';} ?>>
      <?php if(isset($force_hide_product_title2) && $force_hide_product_title2) {/*Hidden title2*/}else{ ?>
      <span class="addon small" data-kerkere='.subTitle' <?php if(\dash\data::productDataRow_title2()) {?> data-kerkere-icon='open' <?php }else{ ?> data-kerkere-icon='close' <?php }//endif ?>><?php echo T_("Technical title"); ?></span>
      <?php } //endif ?>
    </div>
    <?php if(isset($force_hide_product_title2) && $force_hide_product_title2) {/*Hidden title2*/}else{ ?>
    <div class="subTitle" data-kerkere-content='<?php if(\dash\data::productDataRow_title2()) {echo 'show'; }else{ echo 'hide'; } ?>'>
      <div class="input mT10 ltr">
        <input type="text" name="title2" id="title2" placeholder='Technical Title' value="<?php echo \dash\data::productDataRow_title2(); ?>" maxlength='300' minlength="1" pattern=".{1,300}">
      </div>
    </div>
  <?php } //endif ?>
  </div>
</div>