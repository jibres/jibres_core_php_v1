<form method="post" autocomplete="off" class="box impact">
  <header><h2><?php echo T_("Set logo");?></h2></header>
  <div class="body">
    <div class="txtC">
    <?php if(\dash\get::index($header_detail, 'current_detail', 'header_logo_file')) {?>
      <img src="<?php echo \dash\get::index($header_detail, 'current_detail', 'header_logo_file') ?>" class="avatar fs50">
    </div>
      <br>
    <?php } // endif ?>
    <label for="logo"><?php echo T_("Logo"); ?></label>
    <div class="input">
      <input type="file" name="logo" id="logo">
    </div>
  </div>
  <footer class="f">
    <?php if(\dash\data::canUseStoreLogo()) {?>
      <div class="c">
        <div class="btn" data-ajaxify data-data='{"usestorelogo": 1}' data-method='post' ><span><?php echo T_("Use from store logo"); ?></span></div>
      </div>
    <?php } //endif ?>
    <div class="cauto os"><button class="btn success"><?php echo T_("Upload") ?></button></div>


  </footer>
</form>


