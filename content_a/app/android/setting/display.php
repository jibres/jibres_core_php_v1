<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m8 s12">
    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Set your application title and slogan"); ?></h2></header>
      <div class="body">

          <label for="title"><?php echo T_("Application title"); ?> <small class="fc-red fs08"><?php echo T_("Required"); ?></small></label>
          <div class="input">
            <input type="text" name="title" id="title" value="<?php echo \dash\data::appDetail_title(); ?>" maxlength="20" required>
          </div>

          <label for="slogan"><?php echo T_("Application slogan"); ?></label>
          <div class="input">
            <input type="text" name="slogan" id="slogan" value="<?php echo \dash\data::appDetail_slogan(); ?>" maxlength="50">
          </div>

          <label for="desc"><?php echo T_("Application desc"); ?></label>
          <textarea class="txt mB10" name="desc" maxlength="150" rows="3" id="desc" ><?php echo \dash\data::appDetail_desc(); ?></textarea>

      </div>
      <footer class="f">
        <div class="c">
          <a class="ibtn" href="<?php echo \dash\url::that(). '/logo'; ?>"><i data-next></i><span><?php echo T_("Logo"); ?></span></a>

        </div>
        <div class="cauto os"><button class="btn success"><?php echo T_("Save & Next"); ?></button></div>
      </footer>
    </form>
  </div>
  <div class="c6 s12">
<?php require_once(root. 'content_a/app/android/appPreview.php'); ?>
  </div>
</div>


