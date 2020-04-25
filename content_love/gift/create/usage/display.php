<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Set usage of gift card"); ?></h2></header>

      <div class="body">

        <label for="usagetotal"><?php echo T_("Gift total usage limit"); ?></label>
        <div class="input ltr">
          <input type="text" name="usagetotal" value="<?php echo \dash\data::dataRow_usagetotal(); ?>" id="usagetotal" max="9999999" data-format='price'>
        </div>

        <label for="usageperuser"><?php echo T_("Gift usage limit per user"); ?></label>
        <div class="input ltr">
          <input type="text" name="usageperuser" value="<?php echo \dash\data::dataRow_usageperuser(); ?>" id="usageperuser" max="9999999" data-format='price' >
        </div>

        <div>
          <label for="forusein"><?php echo T_("For use in"); ?></label>
          <select class="select22" name="forusein">
            <option value="any" <?php if(\dash\data::dataRow_forusein() === 'any') {echo 'selected'; } ?>><?php echo T_("any") ?></option>
            <option value="domain" <?php if(\dash\data::dataRow_forusein() === 'domain') {echo 'selected'; } ?>><?php echo T_("domain") ?></option>
            <option value="store" <?php if(\dash\data::dataRow_forusein() === 'store') {echo 'selected'; } ?>><?php echo T_("store") ?></option>
            <option value="sms" <?php if(\dash\data::dataRow_forusein() === 'sms') {echo 'selected'; } ?>><?php echo T_("sms") ?></option>
            <option value="ipg" <?php if(\dash\data::dataRow_forusein() === 'ipg') {echo 'selected'; } ?>><?php echo T_("ipg") ?></option>

          </select>
        </div>

        <label for="dedicated"><?php echo T_("Dedicated for users"); ?></label>
        <textarea name="dedicated" class="txt ltr" rows="3" placeholder="<?php echo T_("Every mobile in one line") ?>"><?php echo \dash\data::dataRow_dedicated_string(); ?></textarea>



      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>