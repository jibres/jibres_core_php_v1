
<?php if(\dash\data::savedOption() && is_array(\dash\data::savedOption())) {?>
  <?php foreach (\dash\data::savedOption() as $key => $value) {?>
    <div class="msg f fs14 txtB secondary outline">
      <div class="c">
        <img class="avatar" src="<?php echo \dash\get::index($value, 'image') ?>">
      </div>
      <div class="c"><?php echo \dash\get::index($value, 'url'); ?> <?php if(\dash\get::index($value, 'target')) {?><i class="sf-external-link"></i><?php }// endif ?></div>
    </div>
  <?php } // endfor ?>
<?php } //endif ?>
<div class="f justify-center">
  <div class="c6 m8 s12 x4">
    <form method="post" class="box" autocomplete="off" >
      <header><h2><?php echo T_("Add image and link to"). ' '. \dash\get::index(\dash\data::lineOption(), 'title') ?></h2></header>

      <div class="body">



          <div class="input ">
            <input type="file" name='image' accept="image/gif, image/jpeg, image/png" id="image1" >
            <label for="image1"><?php if(\dash\get::index($box_detail, 'saved', 'header_logo')) {?><img src="<?php echo \dash\get::index($box_detail, 'saved', 'header_logo') ?>"><?php } //endif ?></label>
          </div>


        <label for="url"><?php echo T_("Url"); ?></label>
        <div class="input ltr">
          <input type="text" name="url" id="url" value="<?php echo \dash\data::toplineSaved_url() ?>"  >
        </div>

        <div class="switch1 mB5">
          <input type="checkbox" name="target" id="target" <?php if(\dash\data::toplineSaved_target()) {echo 'checked';} ?>>
          <label for="target"></label>
          <label for="target"><?php echo T_("Open in New tab"); ?><small></small></label>
        </div>

      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Add"); ?></button>
      </footer>

    </form>
  </div>
</div>