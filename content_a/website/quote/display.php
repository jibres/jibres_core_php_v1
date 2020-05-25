<?php $quote_ratio = round(\dash\get::index(\dash\data::lineSetting(), 'ratio_detail', 'ratio'), 2); ?>
<div class="row" >
  <input type="hidden" name="sort" value="sort">
  <?php if(\dash\data::lineSetting_quote() && is_array(\dash\data::lineSetting_quote())) {?>
    <?php foreach (\dash\data::lineSetting_quote() as $key => $value) {?>
    <div class="c-3 c-xs-12">
      <div class="card">
        <div class="img"><img class="avatar" src="<?php echo \dash\get::index($value, 'image') ?>" alt="<?php echo \dash\get::index($value, 'displayname') ?>"></div>
        <div class="body">
          <header>
            <div class="mB10 font-12"><?php echo \dash\get::index($value, 'displayname'); ?> <small><?php echo \dash\get::index($value, 'job'); ?></small></div>
          </header>
          <div class="desc font-12 mB10"><?php echo \dash\get::index($value, 'text'); ?></div>
          <div class="desc ltr"><?php if(\dash\get::index($value, 'star')) { echo str_repeat('⭐️', \dash\get::index($value, 'star')); } ?></div>

        </div>
        <footer class="zeroPad font-14">
          <a href="<?php echo \dash\get::index($value, 'edit_link'); ?>" class="btn  block"><?php if(\dash\get::index($value, 'mod') === 'add') { echo T_("Add new page"); }else{ echo T_("Edit"); } ?></a>
        </footer>
      </div>
    </div>
    <?php } // endfor ?>
  <?php } //endif ?>
</div>
