<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Create new gift card"); ?></h2></header>

      <div class="body">

        <label for="usagetotal"><?php echo T_("Gift total usage limit"); ?></label>
        <div class="input ltr">
          <input type="text" name="usagetotal" value="<?php echo \dash\data::dataRow_usagetotal(); ?>" id="usagetotal" max="9999999" data-format='price'>
        </div>

        <label for="usageperuser"><?php echo T_("Gift usage limit per user"); ?></label>
        <div class="input ltr">
          <input type="text" name="usageperuser" value="<?php echo \dash\data::dataRow_usageperuser(); ?>" id="usageperuser" max="9999999" data-format='price' placeholder="1">
        </div>


      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>