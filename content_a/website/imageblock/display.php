<?php $imageblock_ratio = round(a(\dash\data::lineSetting(), 'ratio_detail', 'ratio'), 2); ?>
<form class="row" data-sortable method="post">
  <input type="hidden" name="sort" value="sort">
  <?php if(\dash\data::lineSetting_imageblock() && is_array(\dash\data::lineSetting_imageblock())) {?>
    <?php foreach (\dash\data::lineSetting_imageblock() as $key => $value) {?>
    <div class="c-3 c-xs-12">
      <div class="card">
        <input type="hidden" class="hide" name="imageblock[]" value="<?php echo $key; ?>">
        <div class="img" data-handle><img src="<?php echo a($value, 'image') ?>" alt="<?php echo a($value, 'alt') ?>"></div>
        <div class="body">
          <header>
            <div class="mB10 font-12"><?php echo a($value, 'alt'); ?></div>
          </header>
          <div class="desc ltr font-10"><?php echo a($value, 'url'); ?> <span><?php if(a($value, 'target')) {?><i class="sf-external-link"></i><?php }// endif ?></span></div>

          <?php if(false && a($value, 'image_ratio') && $imageblock_ratio && round(a($value, 'image_ratio'), 2) != $imageblock_ratio) {?>
            <div class="fc-orange">
              <i class="sf-exclamation-triangle fc-orange"></i> <?php echo T_("This image ratio is not match by imageblock ratio!") ?>
              <?php if(a($value, 'image_ratio_title')) { ?><span class="txtB"><?php echo T_("Image ratio :val", ['val' => \dash\fit::text(a($value, 'image_ratio_title'))]); ?></span><?php } // endif ?>

            </div>
          <?php } // endif ?>
        </div>
        <footer class="zeroPad font-14">
          <a href="<?php echo a($value, 'edit_link'); ?>" class="btn  block"><?php if(a($value, 'mod') === 'add') { echo T_("Add new page"); }else{ echo T_("Edit"); } ?></a>
        </footer>
      </div>
    </div>
    <?php } // endfor ?>
  <?php } //endif ?>
</form>
