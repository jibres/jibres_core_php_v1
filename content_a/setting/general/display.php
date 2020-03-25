<?php
$storeData = \dash\data::store_store_data();
?>


<div class="f">
 <div class="cauto s12 pA10">
<div class="cbox normal">


  <a class="vcard mA10 shadow" <?php if(\dash\permission::check('settingEditLogo'))  { ?>  href='<?php echo \dash\url::here(); ?>/setting/logo' <?php } //endif ?>>
    <img src="<?php echo \dash\get::index($storeData, 'logo'); ?>" alt="<?php echo \dash\get::index($storeData, 'title'); ?>" class="pA10-f">
    <div class="content">
      <div class="header"><?php echo \dash\get::index($storeData, 'title'); ?></div>

    </div>
  </a>


</div>
 </div>
 <div class="c s12 pA10">
  <div class="cbox">
   <form method="post" autocomplete="off">

      <label for="ititle"><?php echo T_("Name"); ?> <span class="fc-red">*</span></label>
      <div class="input">
        <input type="text" name="title" id="ititle" placeholder='<?php echo T_("Name"); ?>' value="<?php echo \dash\get::index($storeData, 'title'); ?>" autofocus maxlength='50' minlength="1"  required>
      </div>

      <label for="desc"><?php echo T_("Description"); ?></label>
      <textarea class="txt mB10" name="desc"  maxlength='2000' rows="3"><?php echo \dash\get::index($storeData, 'desc'); ?></textarea>

      <div class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </div>
   </form>
  </div>


 </div>
</div>


