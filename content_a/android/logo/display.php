<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m8 s12">
    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Set your application logo");?></h2></header>
      <div class="body">

        <div class="box min-y120" data-uploader data-name='logo' data-ratio="1" data-final='#finalImage' data-autoSend>
          <input type="file" accept="image/jpeg, image/png" id="image1">
          <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?> (<?php echo T_("Use a square logo"); ?>)</label>
        </div>

      </div>

      <?php if(\dash\data::canUseStoreLogo()) {?>
        <footer class="f">
          <div class="c">
            <div class="btn" data-ajaxify data-data='{"usestorelogo": 1}' data-method='post' ><span><?php echo T_("Use from store logo"); ?></span></div>
          </div>
        </footer>
      <?php } //endif ?>

    </form>
  </div>
  <div class="c6 s12">
<?php require_once(root. 'content_a/android/appPreview.php'); ?>
  </div>
</div>


