<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m12 s12">
      <form method="post" autocomplete="off" class="box impact">
        <header><h2><?php echo T_("Application Splash setting"); ?></h2></header>
        <div class="body">

        <?php foreach (\dash\data::themeColor() as $key => $value) {?>
          <div class="radio1">
            <input type="radio" name="theme" value="<?php echo \dash\get::index($value, 'start').'_'. \dash\get::index($value, 'end'). '_'. \dash\get::index($value, 'text_color'). '_'. \dash\get::index($value, 'meta_color'); ?>" <?php if(\dash\data::splashSaved_splash_theme() == $key) { echo 'checked';} ?>  id="<?php echo 'splash_'. $key; ?>">
            <label for="<?php echo 'splash_'. $key; ?>"><?php echo \dash\get::index($value, 'title'); ?></label>
          </div>
        <?php }//endfor ?>

          <p class="txtB"><?php echo T_("Advance option");?></p>
          <div>
            <p class="msg warn2"><?php echo T_("If you want to personalize more you need to increase your plan.");?></p>

            <label for='from'><?php echo T_("Gradient From"); ?></label>
            <div class="input">
              <input class="ltr" type="text" name="from" id='from' value="#6DE195" disabled>
            </div>

            <label for='to'><?php echo T_("Gradient To"); ?></label>
            <div class="input">
              <input class="ltr" type="text" name="to" id='to' value="#C4E759" disabled>
            </div>

            <label for='colortext'><?php echo T_("Text color"); ?></label>
            <div class="input">
              <input class="ltr" type="text" name="colortext" id='colortext' value="#000000" disabled>
            </div>

            <label for='colordesc'><?php echo T_("Meta color"); ?></label>
            <div class="input">
              <input class="ltr" type="text" name="colordesc" id='colordesc' value="#333333" disabled>
            </div>

          </div>

        </div>

        <footer class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </footer>

      </form>
  </div>
  <div class="c6 s12">
    <div data-frame='iphone-x' data-activity='splash' data-color='red'>
      <img src="https://cdn.talambar.com/logo/icon/png/Jibres-Logo-icon-512.png" alt='jibres'>
      <h1>Jibres</h1>
      <h2>Sell and Enjoy</h2>
      <div class="desc">#1 World Sales Engineering System</div>
    </div>
  </div>
</div>


