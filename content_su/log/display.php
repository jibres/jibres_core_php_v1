
<?php if(\dash\data::logList()) {?>
  <div class="f">
    <?php foreach (\dash\data::logList() as $key => $value) {?>

      <div class="c4 s12">
          <a class="dcard x1 fc-red"  href='<?php echo \dash\url::this(); ?>?folder=<?php echo a($value, 'name'); ?>'>
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
      <?php if(a($value, 'is_old') || a($value, 'auto_rename') || a($value, 'auto_archive')) {}else{?>
      <tr>

        <td class="ltr">
          <a data-direct href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo a($value, 'name'); ?>'  >
            <?php echo a($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", a($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(a($value, 'size_raw')) ?></td>
        <td><?php echo a($value, 'ext') ?></td>
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
      <?php if(a($value, 'is_old')) {?>
      <tr>

        <td class="ltr">
          <a href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo a($value, 'name'); ?>'  >
            <?php echo a($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", a($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(a($value, 'size_raw')) ?></td>
        <td><?php echo a($value, 'ext') ?></td>
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
      <?php if(a($value, 'auto_rename')) {?>
      <tr>

        <td class="ltr">
          <a href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo a($value, 'name'); ?>'  >
            <?php echo a($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", a($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(a($value, 'size_raw')) ?></td>
        <td><?php echo a($value, 'ext') ?></td>
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
      <?php if(a($value, 'auto_archive')) {?>
      <tr>

        <td class="ltr">
          <a href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo a($value, 'name'); ?>'  >
            <?php echo a($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", a($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(a($value, 'size_raw')) ?></td>
        <td><?php echo a($value, 'ext') ?></td>
      </tr>
      <?php } //endif ?>
    <?php } //endfor ?>
    </tbody>
  </table>
  </div>
</div>
<?php } // endif ?>

