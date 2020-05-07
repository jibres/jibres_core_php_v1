<?php
$storeData = \dash\data::store_store_data();

?>

<section class="f" data-option='store-social-network'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set the social network link");?></h3>
      <div class="body">
        <p><?php echo T_("This item use in your website.");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
     <form class="c4 s12" method="post" autocomplete="off">
    <div class="action f">

      <div class="c12 mB5">
        <div class="input ltr">
          <label class="addon" for="instagram"><?php echo T_("Instagram"); ?></label>
          <input type="text" name="instagram" id="instagram" maxlength="50" value="<?php echo \dash\get::index($storeData, 'instagram'); ?>">
        </div>
      </div>
      <div class="c12 mB5">
        <div class="input ltr">
          <label class="addon" for="telegram"><?php echo T_("Telegram"); ?></label>
          <input type="text" name="telegram" id="telegram" maxlength="50" value="<?php echo \dash\get::index($storeData, 'telegram'); ?>">
        </div>
      </div>
      <div class="c12 mB5">
        <div class="input ltr">
          <label class="addon" for="youtube"><?php echo T_("Youtube"); ?></label>
          <input type="text" name="youtube" id="youtube" maxlength="50" value="<?php echo \dash\get::index($storeData, 'youtube'); ?>">
        </div>
      </div>


      <div class="c12 mT10 txtC">
        <button class="btn block primary"><?php echo T_("Save"); ?></button>
      </div>

    </div>
  </form>
  </form>
</section>
