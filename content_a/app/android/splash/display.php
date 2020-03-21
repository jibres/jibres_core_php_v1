<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m12 s12">
      <form method="post" autocomplete="off" class="box impact">
        <header><h2><?php echo T_("Application Splash setting"); ?></h2></header>
        <div class="body">
          <div class="radio1">
            <input type="radio" name="theme" value="blue" <?php if(\dash\data::splashSaved_splash_theme() == 'blue') { echo 'checked';} ?>  id="sRdc1">
            <label for="sRdc1">Blue (Default)</label>
          </div>

          <div class="radio1 red">
            <input type="radio" name="theme" value="red" <?php if(\dash\data::splashSaved_splash_theme() == 'red') { echo 'checked';} ?>  id="sRdc2">
            <label for="sRdc2">Red</label>
          </div>

          <div class="radio1 yellow">
            <input type="radio" name="theme" value="yellow" <?php if(\dash\data::splashSaved_splash_theme() == 'yellow') { echo 'checked';} ?>  id="sRdc3">
            <label for="sRdc3">Yellow</label>
          </div>

          <div class="radio1 green">
            <input type="radio" name="theme" value="green" <?php if(\dash\data::splashSaved_splash_theme() == 'green') { echo 'checked';} ?>  id="sRdc4">
            <label for="sRdc4">Green</label>
          </div>

          <div class="radio1 black">
            <input type="radio" name="theme" value="balck" <?php if(\dash\data::splashSaved_splash_theme() == 'balck') { echo 'checked';} ?>  id="sRdc5">
            <label for="sRdc5">Black</label>
          </div>

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


