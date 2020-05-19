
  <div class="row">
    <?php if(\dash\data::lineSetting_slider() && is_array(\dash\data::lineSetting_slider())) {?>
      <?php foreach (\dash\data::lineSetting_slider() as $key => $value) {?>
      <div class="c-3 c-xs-12">

        <div class="card">
          <img  src="<?php echo \dash\get::index($value, 'image') ?>" alt="<?php echo \dash\get::index($value, 'alt') ?>" >
          <div class="body">
            <header><?php echo \dash\get::index($value, 'url'); ?></header>
            <div class="meta"><span><?php if(\dash\get::index($value, 'target')) {?><i class="sf-external-link"></i><?php }// endif ?></span></div>
          </div>
          <footer>
            <a href="<?php echo \dash\get::index($value, 'edit_link'); ?>" class="btn primary outline block"><?php if(\dash\get::index($value, 'mod') === 'add') { echo T_("Add new page"); }else{ echo T_("Edit"); } ?></a>
          </footer>
        </div>
      </div>
      <?php } // endfor ?>
    <?php } //endif ?>

  </div>
