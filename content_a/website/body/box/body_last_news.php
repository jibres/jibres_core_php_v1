<div class="f">

<form method="post" autocomplete="off" class="c6 s12">
  <input type="hidden" name="config_line_key" value="<?php echo \dash\get::index($value, 'line_key'); ?>">
  <input type="hidden" name="config_line_type" value="<?php echo \dash\get::index($value, 'key'); ?>">
  <div class="box">
    <header><h2><?php echo T_("Setting"). ' '. \dash\get::index($value, 'title'); ?></h2></header>
    <div class="body">
      <p><?php echo T_("Set count of show news"); ?></p>
      <div>
        <label><?php echo T_("Limit"); ?></label>
        <div class="input">
          <input type="number" name="body_last_news_limit"  value="<?php echo \dash\get::index($value, 'limit'); ?>">
        </div>
      </div>
    </div>

    <footer class="txtRa">
      <button class="btn success"><?php echo T_("Save") ?></button>
    </footer>
  </div>
</form>
</div>
