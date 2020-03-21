<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c8 m12 s12">
    <form method="post" autocomplete="off" class="box">
      <header><h4><?php echo T_("Set your application title logo");?></h4></header>
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


        <?php if(\dash\get::index(\dash\data::appDetail(), 'logo')) {?>
        <div class="mediaBox">
          <img src="<?php echo \dash\get::index(\dash\data::appDetail(), 'logo'); ?>" alt="<?php echo \dash\data::appDetail_title(); ?>" id="logoPreview">
        </div>
        <?php } ?>
      </div>


      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </form>
  </div>
</div>


