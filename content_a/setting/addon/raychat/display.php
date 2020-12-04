<?php
$storeData = \dash\data::store_store_data();
?>


<div class="f justify-center">
 <div class="c6 s12 pA10">
  <form method="post" autocomplete="off">
    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Set raychat live chat setting");?></h2></header>
        <div class="body">
          <p class="mB0-f"><?php echo T_("If you want to have live chat in your website, enter your raychat token code here. \nTo do this, you need to register on raychat.to and get the code from there"); ?></p>
            <label for="iraychat"><?php echo T_("Raychat code"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
            <input type="text" name="addon_raychat" id="iraychat" value="<?php echo \dash\get::index($storeData, 'addon_raychat'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1"  required>
            </div>
        </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
    </div>
  </form>
 </div>
</div>


