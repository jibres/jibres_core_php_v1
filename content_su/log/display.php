
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
<div class="cbox fs11">
  <table class="tbl1 v3 fs12">
    <thead>
      <th><?php echo T_("File"); ?></th>
      <th><?php echo T_("Last modified"); ?></th>
      <th><?php echo T_("Size"); ?></th>
      <th><?php echo T_("Extension"); ?></th>
    </thead>
    <tbody>
    <?php foreach (\dash\data::logFileList() as $key => $value) {?>
      <?php if(\dash\get::index($value, 'is_old') || \dash\get::index($value, 'auto_rename') || \dash\get::index($value, 'auto_archive')) {}else{?>
      <tr>

        <td class="ltr">
          <a href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo \dash\get::index($value, 'name'); ?>'  >
            <?php echo \dash\get::index($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", \dash\get::index($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(\dash\get::index($value, 'size_raw')) ?></td>
        <td><?php echo \dash\get::index($value, 'ext') ?></td>
      </tr>
      <?php } //endif ?>
    <?php } //endfor ?>
    </tbody>
  </table>


  <h2 data-kerkere='.archivedLog' data-kerkere-icon><?php echo T_("Show archived"); ?></h2>
  <div class="archivedLog" data-kerkere-content='hide1'>

     <table class="tbl1 v3 fs12">
    <thead>
      <th><?php echo T_("File"); ?></th>
      <th><?php echo T_("Last modified"); ?></th>
      <th><?php echo T_("Size"); ?></th>
      <th><?php echo T_("Extension"); ?></th>
    </thead>
    <tbody>
    <?php foreach (\dash\data::logFileList() as $key => $value) {?>
      <?php if(\dash\get::index($value, 'is_old')) {?>
      <tr>

        <td class="ltr">
          <a href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo \dash\get::index($value, 'name'); ?>'  >
            <?php echo \dash\get::index($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", \dash\get::index($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(\dash\get::index($value, 'size_raw')) ?></td>
        <td><?php echo \dash\get::index($value, 'ext') ?></td>
      </tr>
      <?php } //endif ?>
    <?php } //endfor ?>
    </tbody>
  </table>
  </div>


  <h2 data-kerkere='.archivedLogRename' data-kerkere-icon><?php echo T_("Auto rename"); ?></h2>
  <div class="archivedLogRename" data-kerkere-content='hide1'>

     <table class="tbl1 v3 fs12">
    <thead>
      <th><?php echo T_("File"); ?></th>
      <th><?php echo T_("Last modified"); ?></th>
      <th><?php echo T_("Size"); ?></th>
      <th><?php echo T_("Extension"); ?></th>
    </thead>
    <tbody>
    <?php foreach (\dash\data::logFileList() as $key => $value) {?>
      <?php if(\dash\get::index($value, 'auto_rename')) {?>
      <tr>

        <td class="ltr">
          <a href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo \dash\get::index($value, 'name'); ?>'  >
            <?php echo \dash\get::index($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", \dash\get::index($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(\dash\get::index($value, 'size_raw')) ?></td>
        <td><?php echo \dash\get::index($value, 'ext') ?></td>
      </tr>
      <?php } //endif ?>
    <?php } //endfor ?>
    </tbody>
  </table>
  </div>


  <h2 data-kerkere='.archivedLogArchive' data-kerkere-icon><?php echo T_("Show auto archived"); ?></h2>
  <div class="archivedLogArchive" data-kerkere-content='hide1'>

     <table class="tbl1 v3 fs12">
    <thead>
      <th><?php echo T_("File"); ?></th>
      <th><?php echo T_("Last modified"); ?></th>
      <th><?php echo T_("Size"); ?></th>
      <th><?php echo T_("Extension"); ?></th>
    </thead>
    <tbody>
    <?php foreach (\dash\data::logFileList() as $key => $value) {?>
      <?php if(\dash\get::index($value, 'auto_archive')) {?>
      <tr>

        <td class="ltr">
          <a href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo \dash\get::index($value, 'name'); ?>'  >
            <?php echo \dash\get::index($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", \dash\get::index($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(\dash\get::index($value, 'size_raw')) ?></td>
        <td><?php echo \dash\get::index($value, 'ext') ?></td>
      </tr>
      <?php } //endif ?>
    <?php } //endfor ?>
    </tbody>
  </table>
  </div>
</div>
<?php } // endif ?>

