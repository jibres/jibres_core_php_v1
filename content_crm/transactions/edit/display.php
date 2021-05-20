<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <label for="title"><?php echo T_("Title") ?></label>
        <div class="input">
          <input type="text" name="title" value="<?php echo \dash\data::dataRow_title() ?>">
        </div>

        <label for="amount"><?php echo T_("Amount") ?></label>
        <div class="input">
          <?php if(\dash\data::dataRow_plus()) { ?>
          <label for="amount" class="addon  fc-green"><?php echo T_("Plus") ?></label>
          <?php }else{ ?>
          <label for="amount" class="addon  fc-red"><?php echo T_("Minus") ?></label>
          <?php  } ?>
          <input type="tel" name="amount" value="<?php if(\dash\data::dataRow_plus()) { echo \dash\data::dataRow_plus(); }else{ echo \dash\data::dataRow_minus(); } ?>" data-format='price' maxlength="19">
        </div>


        <label for="date"><?php echo T_("Date & Time"); ?></label>
        <?php $myDate = \dash\data::dataRow_datecreated(); $myTimeStemp = strtotime($myDate); ?>
        <div class="input">
          <label data-kerkere='.showTime' class="addon btn"><?php echo \dash\fit::text(date("H:i", $myTimeStemp)); ?></label>
          <input type="tel" name="date" id="date" placeholder='<?php echo \dash\fit::date($myDate); ?>' value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date($myDate)) ?>" data-format='date'>
        </div>
        <div data-kerkere-content='hide' class="showTime">
          <div class="input">
            <input type="tel" name="time" id="time" placeholder='<?php echo \dash\fit::text(date("H:i", $myTimeStemp)); ?>' value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::text(date("H:i", $myTimeStemp))) ?>" data-format='time'>

          </div>
        </div>

        <div class="switch1">
          <input id="verify" type="checkbox" name="verify" <?php if(\dash\data::dataRow_verify()) { echo 'checked'; } ?>>
          <label for="verify" data-on='<?php echo T_("Yes") ?>' data-off='<?php echo T_("No") ?>'></label>
          <label for="verify"><?php echo T_("Is valid transactions?") ?></label>
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Update") ?></button>
      </footer>

    </div>
  </form>
</div>