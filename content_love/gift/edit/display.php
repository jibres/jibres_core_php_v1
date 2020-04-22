<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Create new gift card"); ?></h2></header>

      <div class="body">
        <label for="code"><?php echo T_("Gift code"); ?></label>
        <div class="input ltr">
          <input type="text" name="code" value="<?php echo \dash\data::dataRow_code(); ?>" id="code" maxlength="100" >
        </div>

        <label for="usagetotal"><?php echo T_("Gift total usage limit"); ?></label>
        <div class="input ltr">
          <input type="text" name="usagetotal" value="<?php echo \dash\data::dataRow_usagetotal(); ?>" id="usagetotal" max="9999999" data-format='price'>
        </div>

        <label for="usageperuser"><?php echo T_("Gift usage limit per user"); ?></label>
        <div class="input ltr">
          <input type="text" name="usageperuser" value="<?php echo \dash\data::dataRow_usageperuser(); ?>" id="usageperuser" max="9999999" data-format='price' >
        </div>

        <label for="dedicated"><?php echo T_("Dedicated for users"); ?></label>
        <textarea name="dedicated" class="txt ltr" rows="3" placeholder="<?php echo T_("Every mobile in one line") ?>"><?php echo \dash\data::dataRow_dedicated_string(); ?></textarea>


        <div class="mB20">
          <label for="desc"><?php echo T_("Description"); ?></label>
          <textarea id="desc" name="desc" class="txt" rows="5"><?php echo \dash\data::dataRow_msgsuccess(); ?></textarea>
        </div>

        <label for="msgsuccess"><?php echo T_("Success msg"); ?></label>
        <textarea id="msgsuccess" name="msgsuccess" class="txt" rows="5"><?php echo \dash\data::dataRow_msgsuccess(); ?></textarea>

        <label for="giftpercent"><?php echo T_("Gift percent"); ?></label>
        <div class="input ltr">
          <input type="number" name="giftpercent" value="<?php echo \dash\data::dataRow_giftpercent(); ?>" id="giftpercent" min="1" max="100" step="1">
        </div>

        <label for="giftmax"><?php echo T_("Gift max"); ?></label>
        <div class="input ltr">
          <input type="text" name="giftmax" value="<?php echo \dash\data::dataRow_giftmax(); ?>" id="giftmax" max="9999999" data-format='price'>
        </div>

        <label for="giftamount"><?php echo T_("Gift amount"); ?></label>
        <div class="input ltr">
          <input type="text" name="giftamount" value="<?php echo \dash\data::dataRow_giftamount(); ?>" id="giftamount" max="9999999" data-format='price'>
        </div>

        <label for="pricefloor"><?php echo T_("Price floor"); ?></label>
        <div class="input ltr">
          <input type="text" name="pricefloor" value="<?php echo \dash\data::dataRow_pricefloor(); ?>" id="pricefloor" max="9999999" data-format='price'>
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

        <div>
          <label for="status"><?php echo T_("Status"); ?></label>
          <select class="select22" name="status">
            <option value="draft" <?php if(\dash\data::dataRow_status() === 'draft') {echo 'selected'; } ?>><?php echo T_("draft") ?></option>
            <option value="enable" <?php if(\dash\data::dataRow_status() === 'enable') {echo 'selected'; } ?>><?php echo T_("enable") ?></option>
            <option value="disable" <?php if(\dash\data::dataRow_status() === 'disable') {echo 'selected'; } ?>><?php echo T_("disable") ?></option>
            <option value="deleted" <?php if(\dash\data::dataRow_status() === 'deleted') {echo 'selected'; } ?>><?php echo T_("deleted") ?></option>
            <option value="expire" <?php if(\dash\data::dataRow_status() === 'expire') {echo 'selected'; } ?>><?php echo T_("expire") ?></option>
            <option value="blocked" <?php if(\dash\data::dataRow_status() === 'blocked') {echo 'selected'; } ?>><?php echo T_("blocked") ?></option>
          </select>
        </div>

        <label for="dateexpire" ><?php echo T_("Expire date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
        <div class="input">
          <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="dateexpire" value="<?php echo \dash\data::dataRow_dateexpire(); ?>" id="dateexpire" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off'>
        </div>

        <div class="switch1 mB20">
          <input type="checkbox" name="physical" id="physical"  <?php if(\dash\data::dataRow_physical()) { echo 'checked'; } ?> >
          <label for="physical" data-on="<?php echo T_("YES") ?>" data-off="<?php echo T_("NO") ?>"></label>
          <label for="physical"><?php echo T_("Physical card?"); ?></label>
        </div>

        <div class="switch1 mB20">
          <input type="checkbox" name="chap" id="chap"  <?php if(\dash\data::dataRow_chap()) { echo 'checked'; } ?> >
          <label for="chap" data-on="<?php echo T_("YES") ?>" data-off="<?php echo T_("NO") ?>"></label>
          <label for="chap"><?php echo T_("Are you want to print this gift card?"); ?></label>
        </div>





      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>