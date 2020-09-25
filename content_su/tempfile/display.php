<div class="msg  xl txtB txtC">
<?php echo T_("Remove all temp file") ?>
<div data-confirm data-data='{"remove": "remove"}' class="btn linkDel"><?php echo T_("Remove now") ?></div>
</div>
<?php if(\dash\data::logList()) {?>
  <div class="f">
    <?php foreach (\dash\data::logList() as $key => $value) {?>

      <div class="c4 s12">
          <a class="dcard x1 fc-red"  href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\get::index($value, 'name'); ?>'>
           <div class="statistic ">
            <div class="value "><i class="sf-<?php echo \dash\get::index($value, 'icon'); ?>"></i></div>
            <div class="label"><?php echo \dash\get::index($value, 'name'); ?></div>
           </div>
          </a>
       </div>
    <?php } //endfor ?>
  </div>

<?php } // endif ?>

<?php if(\dash\data::logFileList()) {?>

<a class="btn mB10 outline primary block" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Back"); ?></a>
<div class="f">
  <?php foreach (\dash\data::logFileList() as $key => $value) {?>
    <?php if((isset($value['is_old']) && !$value['is_old']) || !isset($value['is_old'])) {?>

    <div class="c2 mA5 txtC">
      <a class="msg block" href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo \dash\get::index($value, 'name'); ?>'  >
        <i class="sf-file-1 fs30"></i>
        <div class="label ltr txtB mT5"><?php echo \dash\get::index($value, 'name'); ?></div>
        <div class=" txtC mT10 ltr"><?php echo \dash\fit::date_human($value['mtime']); ?></div>
        <div class="label txtB"><?php echo \dash\fit::text($value['size']); ?> <?php echo T_("MB"); ?></div>
      </a>
    </div>
  <?php } //endif ?>
<?php }//endfor ?>
</div>

<?php } // endif ?>

