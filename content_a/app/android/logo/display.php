<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m8 s12">
    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Set your application title logo");?></h2></header>
      <div class="body">
        <label for="logo"><?php echo T_("Logo"); ?> <small><?php echo T_("Use a square logo in png format"); ?></small></label>
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
        <div class="cauto os"><button class="btn success"><?php echo \dash\data::nextBtn(); ?></button></div>


      </footer>
    </form>
  </div>
  <div class="c6 s12">
<?php require_once(root. 'content_a/app/android/appPreview.php'); ?>
  </div>
</div>


