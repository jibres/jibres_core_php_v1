
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

  <?php HTML_table_show_file(\dash\data::logFileList(), 'new'); ?>

  <h2 data-kerkere='.archivedLog' data-kerkere-icon><?php echo T_("Show archived"); ?></h2>
  <div class="archivedLog" data-kerkere-content='hide1'>
    <?php HTML_table_show_file(\dash\data::logFileList(), 'is_old'); ?>
  </table>
  </div>


  <h2 data-kerkere='.archivedLogRename' data-kerkere-icon><?php echo T_("Auto rename"); ?></h2>
  <div class="archivedLogRename" data-kerkere-content='hide1'>
    <?php HTML_table_show_file(\dash\data::logFileList(), 'auto_rename'); ?>

  </table>
  </div>


  <h2 data-kerkere='.archivedLogArchive' data-kerkere-icon><?php echo T_("Show auto archived"); ?></h2>
  <div class="archivedLogArchive" data-kerkere-content='hide1'>
    <?php HTML_table_show_file(\dash\data::logFileList(), 'auto_archive'); ?>
  </div>
</div>
<?php } // endif ?>



<?php function HTML_table_show_file($data, $type) {?>
   <table class="tbl1 v3 fs12">
    <thead>
      <th><?php echo T_("File"); ?></th>
      <th><?php echo T_("Last modified"); ?></th>
      <th><?php echo T_("Size"); ?></th>
      <th><?php echo T_("Extension"); ?></th>
      <th></th>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) {?>
      <?php if(a($value, $type)) {?>
      <tr>

        <td class="ltr">
          <a href='<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>&file=<?php echo a($value, 'name'); ?>'  >
            <?php echo a($value, 'name') ?>
          </a>
        </td>
        <td><?php echo \dash\fit::date_human(date("Y-m-d H:i:s", a($value, 'mtime'))) ?></td>
        <td><?php echo \dash\fit::file_size(a($value, 'size_raw')) ?></td>
        <td><?php echo a($value, 'ext') ?></td>
        <td>
          <a target="_blank" data-direct class="btn link" href='<?php echo \dash\url::this() . \dash\request::full_get(['file' => a($value, 'name') ]); ?>'>Download</a>
        <?php if(a($value, 'new')) {?>
          <div class="btn link"></div>
          <a data-direct class="btn link" href='<?php echo \dash\url::this() . \dash\request::full_get(['file' => a($value, 'name'), 'clear' => 1 ]); ?>'>Clean</a>
        <?php } //endif ?>

        </td>
      </tr>
      <?php } //endif ?>
    <?php } //endfor ?>
    </tbody>
  </table>
<?php } //endif ?>
