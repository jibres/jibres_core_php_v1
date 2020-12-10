<?php
$storeData = \dash\data::store_store_data();
?>


<div class="f justify-center">
 <div class="c6 s12 pA10">
  <form method="post" autocomplete="off">
    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Set tawk live chat setting");?></h2></header>
        <div class="body">
          <p class="mB0-f"><?php echo T_("If you want to have live chat in your website, enter your tawk token code here. \nTo do this, you need to register on tawk.to and get the code from there"); ?></p>
            <label for="itawk"><?php echo T_("Tawk code"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
            <input type="text" name="addon_tawk" id="itawk" value="<?php echo a($storeData, 'addon_tawk'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1"  required>
            </div>
        </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
    </div>
  </form>
 </div>
</div>


