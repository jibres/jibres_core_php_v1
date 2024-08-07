<?php
$tg = \dash\data::tg();
?>

<form class="box p-4" method="post" autocomplete="off">
  <div class="input ltr mb-2">
    <label for="chatid"><?php echo T_("Chat id or username"); ?></label>
    <input type="text" name="chatid" id="chatid" value="46898544" placeholder='<?php echo T_("Unique identifier for the target chat or username of the target channel (in the format @channelusername)"); ?>' required>
  </div>

  <label for="text"><?php echo T_("Message"); ?></label>
  <textarea class="txt mb-2" name="text" id="text" rows="7" placeholder='<?php echo T_("Text of the message to be sent"); ?>' required>
    <?php echo \dash\face::site(); ?>

    <?php echo \dash\fit::date(date("Y-m-d")); ?>
    <?php echo \dash\fit::text(date("H:i:s")); ?>

</textarea>

  <button class="btn-primary block"><?php echo T_("Send"); ?></button>
</form>

<?php if(isset($tg['send'])) {?>


<div class="box p-4">
  <h2><?php echo T_("Last request"); ?></h2>
  <div class="alert-info">
    <pre><?php echo a($tg, 'send'); ?></pre>
  </div>
  <div class="alert2">
    <pre><?php echo a($tg, 'response'); ?></pre>
  </div>
</div>
<?php } ?>
