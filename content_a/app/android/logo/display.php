<?php require_once(core. 'layout/tools/stepGuide.php'); ?>
<div class="f justify-center">
  <div class="c8 m12 s12">
    <div class="cbox">
      <?php if(\dash\data::appQueue()) {?>
        <div class="msg warn2"><?php echo T_("Changing these values ​​will need to be rebuilt") ?></div>
      <?php } //endif ?>
      <h4><?php echo T_("Set your application title logo"); ?></h4>

      <form method="post" autocomplete="off">


        <?php if(\dash\get::index(\dash\data::appDetail(), 'logo')) {?>
        <div class="mediaBox mB20">
          <img src="<?php echo \dash\get::index(\dash\data::appDetail(), 'logo'); ?>" alt="<?php echo \dash\data::appDetail_title(); ?>" id="logoPreview">
        </div>
        <?php } ?>



        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>


