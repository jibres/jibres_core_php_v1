<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c6 m8 s12">
    <form method="post" autocomplete="off" class="box">
      <header><h2><?php echo T_("Set your application title and logo"); ?></h2></header>
      <div class="body zeroPad">
        <?php if(\dash\data::appQueue()) {?>
          <div class="msg warn2 mB0"><?php echo T_("Changing these values ​​will need to be rebuilt") ?></div>
        <?php } //endif ?>
      </div>
      <div class="body">

          <label for="title"><?php echo T_("Application title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="title" value="<?php echo \dash\data::appDetail_title(); ?>" maxlength="20">
          </div>

          <label for="slogan"><?php echo T_("Application slogan"); ?></label>
          <div class="input">
            <input type="text" name="slogan" id="slogan" value="<?php echo \dash\data::appDetail_slogan(); ?>" maxlength="50">
          </div>

          <label for="desc"><?php echo T_("Application desc"); ?></label>
          <textarea class="txt mB10" name="desc" maxlength="150" rows="3" id="desc" ><?php echo \dash\data::appDetail_desc(); ?></textarea>

      </div>
      <footer class="txtRa"><button class="btn success"><?php echo T_("Save"); ?></button></footer>
    </form>
  </div>
</div>


