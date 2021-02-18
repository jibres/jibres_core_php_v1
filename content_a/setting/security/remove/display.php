<?php
$storeData = \dash\data::store_store_data();
?>

<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="pad">
        <div class="msg danger2">
          <?php echo T_("Be careful, You are deleting your business!") ?>
        </div>
        <p>
          <?php echo T_("To do this, you must enter your business subdomain name. \nPlease note that we will keep your information for a while and also the subdomain of your choice will still be reserved") ?>
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



