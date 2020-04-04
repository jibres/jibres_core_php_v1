<?php
$storeData = \dash\data::store_store_data();
?>


<div class="f justify-center">
 <div class="c6 s12 pA10">
  <form method="post" autocomplete="off">
    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Set google analytics");?></h2></header>
        <div class="body">
          <p class="mB0-f"><?php echo T_("If you want to have the details of your website in full detail, please enter your Google Analytics code here. \nTo do this, you need to register on Google Analytics and get the code from there"); ?></p>
            <label for="igoogleanalytics"><?php echo T_("Google Analytics code"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
              <input type="text" name="google_analytics" id="igoogleanalytics"  value="<?php echo \dash\get::index($storeData, 'google_analytics'); ?>" autofocus maxlength='50' minlength="1"  required>
            </div>
        </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
    </div>
  </form>
 </div>
</div>


