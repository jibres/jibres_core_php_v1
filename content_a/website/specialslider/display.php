<?php if(\dash\data::lineSetting_specialslider() && is_array(\dash\data::lineSetting_specialslider()) && count(\dash\data::lineSetting_specialslider()) >= 5) {/*nothing*/}else{?>
  <div class="msg warn fs14 txtC"><?php echo T_("You must have at least 5 pages or more to display this slider") ?></div>
<?php } //endif ?>
<?php $specialslider_ratio = round(\dash\get::index(\dash\data::lineSetting(), 'ratio_detail', 'ratio'), 2); ?>
<form class="row" data-sortable method="post">
  <input type="hidden" name="sort" value="sort">
  <?php if(\dash\data::lineSetting_specialslider() && is_array(\dash\data::lineSetting_specialslider())) {?>
    <?php foreach (\dash\data::lineSetting_specialslider() as $key => $value) {?>
    <div class="c-3 c-xs-12 mB20">
      <div class="card">
        <input type="hidden" class="hide" name="specialslider[]" value="<?php echo $key; ?>">
        <div class="img" data-handle><img src="<?php echo \dash\get::index($value, 'image') ?>" alt="<?php echo \dash\get::index($value, 'alt') ?>"></div>
        <div class="body">
          <header>
            <div class="mB10 font-12"><?php echo \dash\get::index($value, 'alt'); ?></div>
          </header>
          <div class="desc ltr font-10"><?php echo \dash\get::index($value, 'url'); ?> <span><?php if(\dash\get::index($value, 'target')) {?><i class="sf-external-link"></i><?php }// endif ?></span></div>

          <?php if(\dash\get::index($value, 'image_ratio') && $specialslider_ratio && round(\dash\get::index($value, 'image_ratio'), 2) != $specialslider_ratio) {?>
            <div class="fc-orange">
              <i class="sf-exclamation-triangle fc-orange"></i> <?php echo T_("This image ratio is not match by special slider ratio!") ?>
              <?php if(\dash\get::index($value, 'image_ratio_title')) { ?><span class="txtB"><?php echo T_("Image ratio :val", ['val' => \dash\fit::text(\dash\get::index($value, 'image_ratio_title'))]); ?></span><?php } // endif ?>

            </div>
          <?php } // endif ?>
        </div>
        <footer class="zeroPad font-14">
          <a href="<?php echo \dash\get::index($value, 'edit_link'); ?>" class="btn  block"><?php if(\dash\get::index($value, 'mod') === 'add') { echo T_("Add new page"); }else{ echo T_("Edit"); } ?></a>
        </footer>
      </div>
    </div>
    <?php } // endfor ?>
  <?php } //endif ?>
</form>
