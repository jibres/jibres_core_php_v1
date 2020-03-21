<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m8 s12">
    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Set your application title logo");?></h2></header>
      <div class="body zeroPad">
<?php if(\dash\data::appQueue()) {?>
        <div class="msg warn2 mB0"><?php echo T_("Changing these values ​​will need to be rebuilt") ?></div>
<?php } //endif ?>
      </div>

      <div class="body">
        <label for="logo"><?php echo T_("Logo"); ?> <small><?php echo T_("Use a square logo in png format"); ?></small></label>
        <div class="input">
          <input type="file" name="logo" id="logo">
        </div>
      </div>


      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </form>
  </div>
  <div class="c6 s12">
<?php require_once(root. 'content_a/app/android/appPreview.php'); ?>
  </div>
</div>


