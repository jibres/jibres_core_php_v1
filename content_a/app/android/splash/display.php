<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m12 s12">
    <div class="cbox">
      <form method="post" autocomplete="off">
        <h4><?php echo T_("Splash setting"); ?></h4>

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

        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </div>

      </form>
    </div>
  </div>
</div>


