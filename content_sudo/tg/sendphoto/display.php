

<?php
$tg = \dash\data::tg();
?>

<form class="box p-4" method="post" autocomplete="off">
  <div class="input ltr mb-2">
    <label for="chatid"><?php echo T_("Chat id or username"); ?></label>
    <input type="text" name="chatid" id="chatid" value="46898544" placeholder='<?php echo T_("Unique identifier for the target chat or username of the target channel (in the format @channelusername)"); ?>' required>
  </div>

  <div class="input ltr mb-2">
    <label for="file1"><?php echo T_("File URL"); ?></label>
    <input type="text" name="file1" id="file1" value="https://ermile.com/static/images/logo.png" placeholder='<?php echo T_("pass an HTTP URL as a String for Telegram to get a photo from the Internet"); ?>'>
  </div>

  <div class="input preview pTB10">
    <input type="file" name="file2" accept="image/gif, image/jpeg, image/png" id="file2" data-preview="">
    <label for="file2" data-tippy="" data-original-content_account\my></label>
  </div>


  <label for="text"><?php echo T_("Caption"); ?></label>
  <textarea class="txt mb-2" name="text" id="text" rows="7" placeholder='<?php echo T_("Text of the message to be sent"); ?>'><?php echo \dash\face::site(); ?></textarea>

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

