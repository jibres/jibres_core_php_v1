<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m12 s12">
      <form method="post" autocomplete="off" class="box impact">
        <header><h2><?php echo T_("Application Splash setting"); ?></h2></header>
        <div class="body">
          <div class="colors mB20">
<?php foreach (\dash\data::themeColor() as $key => $value) {?>
            <div class="radio3 colored">
              <input type="radio" name="theme" value="<?php echo \dash\get::index($value, 'start').'_'. \dash\get::index($value, 'end'). '_'. \dash\get::index($value, 'text_color'). '_'. \dash\get::index($value, 'meta_color'); ?>" <?php if(\dash\data::splashSaved_key() == \dash\get::index($value, 'key')) { echo 'checked';} ?>  id="<?php echo 'splash_'. $key; ?>">
              <label for="<?php echo 'splash_'. $key; ?>" style="background: linear-gradient(0deg, <?php echo \dash\get::index($value, 'start') ?>, <?php echo \dash\get::index($value, 'end'); ?>); color:<?php echo \dash\get::index($value, 'text_color'); ?> ;"></label>
            </div>
<?php }//endfor ?>
          </div>

          <div class="txtB" data-kerkere=".splashAdvanceOption" data-kerkere-icon data-kerkere-single><?php echo T_("Advance option");?></div>

          <div class="splashAdvanceOption" data-kerkere-content='hide'>
            <p class="msg warn2 mT10"><?php echo T_("If you want to personalize more you need to increase your plan.");?></p>

            <div class="f">
              <div class="c6 s12 pRa10">
                <label for='start'><?php echo T_("Gradient Start"); ?></label>
                <div class="input">
                  <input class="ltr" type="text" name="start" id='start' value="<?php echo \dash\data::splashSaved_start(); ?>" disabled>
                </div>

              </div>
              <div class="c6 s12">
                <label for='end'><?php echo T_("Gradient End"); ?></label>
                <div class="input">
                  <input class="ltr" type="text" name="end" id='end' value="<?php echo \dash\data::splashSaved_end(); ?>" disabled>
                </div>
              </div>
            </div>

            <div class="f">
              <div class="c6 s12 pRa10">
                <label for='colortext'><?php echo T_("Text color"); ?></label>
                <div class="input">
                  <input class="ltr" type="text" name="colortext" id='colortext' value="<?php echo \dash\data::splashSaved_text_color(); ?>" disabled>
                </div>
              </div>
              <div class="c6 s12">
                <label for='colordesc'><?php echo T_("Meta color"); ?></label>
                <div class="input">
                  <input class="ltr" type="text" name="colordesc" id='colordesc' value="<?php echo \dash\data::splashSaved_meta_color(); ?>" disabled>
                </div>
              </div>
            </div>

          </div>

        </div>

      <footer class="f">

        <div class="cauto os"><button class="btn success"><?php echo \dash\data::nextBtn(); ?></button></div>
      </footer>

      </form>
  </div>
  <div class="c6 s12">
<?php require_once(root. 'content_a/android/appPreview.php'); ?>
  </div>
</div>


