
  <form class="row" data-sortable method="post">
    <?php if(\dash\data::lineSetting_slider() && is_array(\dash\data::lineSetting_slider())) {?>
      <?php foreach (\dash\data::lineSetting_slider() as $key => $value) {?>
      <div class="c-3 c-xs-12">
        <div class="card">
          <input type="hidden" class="hide" name="slider[]" value="<?php echo $key; ?>">
          <div class="img" data-handle><img src="<?php echo \dash\get::index($value, 'image') ?>" alt="<?php echo \dash\get::index($value, 'alt') ?>"></div>
          <div class="body">
            <header>
              <div class="mB10 font-12"><?php echo \dash\get::index($value, 'alt'); ?></div>
            </header>
            <div class="desc ltr font-10"><?php echo \dash\get::index($value, 'url'); ?> <span><?php if(\dash\get::index($value, 'target')) {?><i class="sf-external-link"></i><?php }// endif ?></span></div>
          </div>
          <footer class="zeroPad font-14">
            <a href="<?php echo \dash\get::index($value, 'edit_link'); ?>" class="btn primary outline block"><?php if(\dash\get::index($value, 'mod') === 'add') { echo T_("Add new page"); }else{ echo T_("Edit"); } ?></a>
          </footer>
        </div>
      </div>
      <?php } // endfor ?>
    <?php } //endif ?>
  </form>
