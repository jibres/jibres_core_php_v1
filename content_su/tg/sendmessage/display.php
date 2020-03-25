<?php
$tg = \dash\data::tg();
?>

<form class="cbox" method="post" autocomplete="off">
  <div class="input ltr mB10">
    <label for="chatid"><?php echo T_("Chat id or username"); ?></label>
    <input type="text" name="chatid" id="chatid" value="46898544" placeholder='<?php echo T_("Unique identifier for the target chat or username of the target channel (in the format @channelusername)"); ?>' required>
  </div>

  <label for="text"><?php echo T_("Message"); ?></label>
  <textarea class="txt mB10" name="text" id="text" rows="7" placeholder='<?php echo T_("Text of the message to be sent"); ?>' required>
    <?php echo \dash\face::site(); ?>

    <?php echo \dash\fit::date(date("Y-m-d")); ?>
    <?php echo \dash\fit::text(date("H:i:s")); ?>

</textarea>

  <button class="btn primary block"><?php echo T_("Send"); ?></button>
</form>

<?php if(isset($tg['send'])) {?>


<div class="cbox">
  <h2><?php echo T_("Last request"); ?></h2>
  <div class="msg info2">
    <pre><?php echo \dash\get::index($tg, 'send'); ?></pre>
  </div>
  <div class="msg">
    <pre><?php echo \dash\get::index($tg, 'response'); ?></pre>
  </div>
</div>
<?php } ?>
