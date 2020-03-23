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

        <?php if(\dash\data::canUseStoreLogo()) {?>
        <div class="msg info2 f align-center">
          <div class="cauto s12">
            <img class="avatar fs14" src="<?php echo \lib\store::logo(); ?>">
          </div>
          <div class="c s12 mLa20">
            <?php echo T_("You can use from your store logo"); ?>
          </div>
          <div class="cauto s12">
            <div class="btn primary" data-ajaxify data-data='{"usestorelogo": 1}' data-method='post'><?php echo T_("Set as application logo"); ?></div>
          </div>
        </div>
        <?php } //endif ?>

        <?php if(\dash\data::appDetail_logo()) {?>
          <div class="msg f align-center">

          <div class="c s12 mLa20">
            <?php echo T_("Remove application logo"); ?>
          </div>
          <div class="cauto s12">
            <div class="link fc-red" data-confirm data-data='{"removelogo": 1}' ><?php echo T_("Remove"); ?></div>
          </div>
        </div>
        <?php } //endif ?>

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


