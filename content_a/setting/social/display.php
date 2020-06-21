<?php
$storeData = \dash\data::store_store_data();

?>

<div class="f justify-center">
 <div class="c6 s12 pA10">

    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Set the social network link");?></header>
        <div class="body">
        <p><?php echo T_("This item use in your website.");?></p>
          <form class="c4 s12" method="post" autocomplete="off">
            <div class="action f">

              <div class="c12 mB5">
                <label for="instagram"><?php echo T_("Instagram"); ?></label>
                <div class="input ltr">
                  <input type="text" name="instagram" id="instagram" maxlength="50" value="<?php echo \dash\get::index($storeData, 'instagram'); ?>">
                </div>
              </div>
              <div class="c12 mB5">
                <label for="telegram"><?php echo T_("Telegram"); ?></label>
                <div class="input ltr">
                  <input type="text" name="telegram" id="telegram" maxlength="50" value="<?php echo \dash\get::index($storeData, 'telegram'); ?>">
                </div>
              </div>
              <div class="c12 mB5">
                <label for="youtube"><?php echo T_("Youtube"); ?></label>
                <div class="input ltr">
                  <input type="text" name="youtube" id="youtube" maxlength="50" value="<?php echo \dash\get::index($storeData, 'youtube'); ?>">
                </div>
              </div>

            </div>
          </form>
        </div>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
    </div>

 </div>
</div>

