<?php
$storeData = \dash\data::store_store_data();
?>

<form method="post" autocomplete="off">
  <?php \dash\csrf::html(); ?>
  <div class="avand-md">
    <div class="box">
      <div class="pad">
        <div class="msg danger2">
          <?php echo T_("Be careful, You are deleting your business!") ?>
        </div>
        <p>
          <?php echo T_("To do this, you must enter your business subdomain name."); ?>
          <br>
          <?php echo T_("All your business information will be deleted and will not be recovered."); ?>
        </p>
        <div class="check1">
          <input type="checkbox" name="sure" id="sure">
          <label for="sure"><?php echo T_("Are you sure you want to delete your business?") ?></label>
        </div>

        <div data-response='sure' data-response-hide>
          <label for="subdomain"><?php echo T_("Please enter the business subdomain") ?></label>
          <div class="input ltr">
            <input type="text" name="subdomain" id="subdomain">
          </div>
          <div class="fc-mute">
            <?php echo T_("Your business subdomain is :val", ['val' => '<b>'. \lib\store::detail('subdomain'). '</b>']); ?>
          </div>
        </div>
      </div>
      <footer class="f">
        <div class="cauto"><a class="btn secondary outline" href="<?php echo \dash\url::that() ?>"><?php echo T_("Cancel") ?></a></div>
        <div class="c"></div>

        <div class="cauto"><div data-response='sure' data-response-hide><button class="btn danger"><?php echo T_("Confirm and delete business"); ?></button></div></div>

      </footer>
    </div>
  </div>
</form>



