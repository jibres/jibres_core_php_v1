<?php require_once(core. 'layout/tools/stepGuide.php'); ?>


<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" enctype="multipart/form-data" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Upload Identify image"); ?></h2></header>

      <div class="body">

        <label for="nationalpic1"><?php echo T_("National card pic") ?></label>
        <div class="input">
          <input type="file" accept="image/gif, image/jpeg, image/png" name="nationalpic" data-max="1000" id="nationalpic1">
        </div>
        <?php if(\dash\data::profileDetail_pre_nationalpic()) {?>
          <img src="<?php echo \dash\data::profileDetail_pre_nationalpic(); ?>" class="box200">
        <?php } //endif ?>


        <label for="shpic1"><?php echo T_("Identify card pic") ?></label>
        <div class="input">
          <input type="file" accept="image/gif, image/jpeg, image/png" name="shpic" data-max="1000" id="shpic1">
        </div>
        <?php if(\dash\data::profileDetail_pre_shpic()) {?>
          <img src="<?php echo \dash\data::profileDetail_pre_shpic(); ?>" class="box200">
        <?php } //endif ?>

      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>


