<div class="msg  xl font-bold text-center">
<?php echo T_("Remove all temp file") ?>
<div data-confirm data-data='{"remove": "remove"}' class="btn-link-danger"><?php echo T_("Remove now") ?></div>
</div>
<?php if(\dash\data::logList()) {?>
  <div class="f">
    <?php foreach (\dash\data::logList() as $key => $value) {?>

      <div class="c4 s12">
          <a class="dcard x1 text-red-800"  href='<?php echo \dash\url::that(). '/'. a($value, 'name'); ?>'>
           <div class="statistic ">
            <div class="value "><i class="sf-<?php echo a($value, 'icon'); ?>"></i></div>
            <div class="label"><?php echo a($value, 'name'); ?></div>
           </div>
          </a>
       </div>
    <?php } //endfor ?>
  </div>

<?php } // endif ?>

<?php if(\dash\data::logFileList()) {?>

<div class="f">
  <?php foreach (\dash\data::logFileList() as $key => $value) {?>
    <?php if((isset($value['is_old']) && !$value['is_old']) || !isset($value['is_old'])) {?>
    <div class="c mA5 text-center">
      <a data-direct class="msg block" href='<?php echo \dash\url::current() .'/'. a($value, 'name'); ?>'  >
        <div class="label ltr font-bold"><?php echo a($value, 'name'); ?></div>
      </a>
    </div>
  <?php } //endif ?>
<?php }//endfor ?>
</div>

<?php } // endif ?>

