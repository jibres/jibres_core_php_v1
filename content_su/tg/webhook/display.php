
<?php
$tg = \dash\data::tg();
// $hook = \dash\data::hook();
?>

<form class="cbox" method="post" autocomplete="off">
  <div class="input ltr mB10">
    <label for="url"><?php echo T_("Chat id or username"); ?></label>
    <input type="url" name="url" id="url" placeholder='<?php echo T_("HTTPS url to send updates to. Use an empty string to remove webhook integration"); ?>' value="">
  </div>

  <div class="input ltr mB10">
    <label for="max_connections"><?php echo T_("Max Connections"); ?></label>
    <input type="number" name="max_connections" id="max_connections" min="0" max="200" placeholder='<?php echo T_("Defaults to 40"); ?>'>
  </div>

  <button class="btn danger block"><?php echo T_("Set Webhook"); ?></button>
</form>

<pre class="msg info2 fs16"></pre>




<div class="msg txtC fs18"><?php echo date("Y-m-d H:i:s"); ?></div>

<?php if(isset($tg['send'])) {?>


<div class="cbox">
  <h2><?php echo T_("Last request"); ?></h2>
  <div class="msg info2">
    <pre><?php echo @$tg['send']; ?></pre>
  </div>
  <div class="msg">
    <pre><?php echo @$tg['response']; ?></pre>
  </div>
</div>
<?php } ?>
