<?php
$storeData = \dash\data::store_store_data();
?>


<div class="f">
 <div class="cauto s12 pA10">
<div class="cbox normal">


  <a class="vcard mA10 shadow" <?php if(\dash\permission::check('settingEditLogo'))  { ?>  href='<?php echo \dash\url::here(); ?>/logo' <?php } //endif ?>>
    <img src="<?php echo @$storeData['logo']; ?>" alt="<?php echo @$storeData['title']; ?>" class="pA10-f">
    <div class="content">
      <div class="header"><?php echo @$storeData['title']; ?></div>

    </div>
  </a>


</div>
 </div>
 <div class="c s12 pA10">
  <div class="cbox">
   <form method="post" autocomplete="off">

      <label for="ititle"><?php echo T_("Name"); ?> <span class="fc-red">*</span></label>
      <div class="input">
        <input type="text" name="title" id="ititle" placeholder='<?php echo T_("Name"); ?>' value="<?php echo @$storeData['title']; ?>" autofocus maxlength='50' minlength="1"  required>
      </div>

      <label for="desc"><?php echo T_("Description"); ?></label>
      <textarea class="txt mB10" name="desc"  maxlength='2000' rows="3"><?php echo @$storeData['desc']; ?></textarea>

      <div class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </div>
   </form>
  </div>


 </div>
</div>

<div class="cbox">

  <div class="pA20">

    <p><?php echo T_("Stroe settings"); ?></p>

    <ul>
        <li><a href="<?php echo \dash\url::this(); ?>/address"><?php echo T_("Set your store address"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/company"><?php echo T_("Store legal information"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/logo"><?php echo T_("Set logo of your store"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/payment"><?php echo T_("Payment channels"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/pos"><?php echo T_("Point of sale hardwares"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/shipping"><?php echo T_("Setting up shipping rates"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/units"><?php echo T_("Store Units"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/vat"><?php echo T_("Tax settings"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/pcpos"><?php echo T_("PC-POS setting"); ?></a></li>

    </ul>

  </div>

</div>


