<?php require_once(core. 'layout/tools/stepGuide.php'); ?>


<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
        <header><h2><?php echo T_("Add your IPG detail"); ?></h2></header>
      <div class="body">

          <label for="ititle"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title" placeholder="" value="<?php echo \dash\data::gatewayDetail_title(); ?>" id="ititle"  maxlength="100">
          </div>

          <label for="iwebsiteurl"><?php echo T_("Website"); ?></label>
          <div class="input ltr">
            <input type="url" name="websiteurl" placeholder="" value="<?php echo \dash\data::gatewayDetail_websiteurl(); ?>" id="iwebsiteurl"  maxlength="100" required>
          </div>

          <label for="iemail"><?php echo T_("Email"); ?></label>
          <div class="input ltr">
            <input type="email" name="email" placeholder="" value="<?php echo \dash\data::gatewayDetail_email(); ?>" id="iemail"  maxlength="100" required>
          </div>

          <label for="iphone"><?php echo T_("Phone"); ?></label>
          <div class="input ltr">
            <input type="tel" name="phone" placeholder="" value="<?php echo \dash\data::gatewayDetail_phone(); ?>" id="iphone"  data-format='tel' maxlength="100">
          </div>

      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>


