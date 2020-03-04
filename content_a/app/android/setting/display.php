
<div class="f justify-center">
  <div class="c8 m12 s12">
    <div class="cbox">
      <h4><?php echo T_("Set your application title and logo"); ?></h4>

      <form method="post" autocomplete="off">

        <label for="title"><?php echo T_("Application title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title" value="<?php echo \dash\data::appDetail_title(); ?>" maxlength="50">
        </div>

        <label for="logo"><?php echo T_("Logo"); ?></label>
        <div class="input">
          <input type="file" name="logo" id="logo">
        </div>

        <?php if(\dash\data::appDetail_logo()) {?>
        <div class="mediaBox mB20">
          <img src="<?php echo \dash\data::appDetail_logo(); ?>" alt="<?php echo \dash\data::appDetail_title(); ?>" id="logoPreview">
        </div>
        <?php } ?>


        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>


