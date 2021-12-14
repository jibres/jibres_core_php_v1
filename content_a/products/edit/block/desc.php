<?php if(!\dash\detect\device::detectPWA()) {?>
  <div class="box">
    <div class="pad ovv">
      <textarea name="html" data-editor class="txt" rows="3" maxlength="2000" placeholder='<?php echo T_("Description about product"); ?>'><?php echo a(\dash\data::productDataRow(),'desc'); ?></textarea>
    </div>
  </div>
<?php  } //endif ?>