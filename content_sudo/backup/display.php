
<?php if(\dash\data::autoBackupLog() || \dash\request::get('show') === 'log') {?>

<div class="box p-4">
    <p><a href="<?php echo \dash\url::here(); ?>/backup" class="badge primary"><?php echo T_("Back"); ?></a></p>
    <?php if(\dash\data::autoBackupLog()) {?>
    <pre>
      <?php echo \dash\data::autoBackupLog(); ?>

    <?php }else{ ?>

      <i><?php echo T_("File is empty"); ?>...</i>
    <?php } ?>
    </pre>
</div>
<?php }else{ ?>

<div class="avand-md">

  <div class="c12 s12 pRa10">
    <div class="box p-4">
      <h6><?php echo T_("Database info"); ?></h6>
      <div class="alert2">
        <li>Trafic received: <span><?php echo \dash\fit::number((((\dash\data::mysqlInfo_Bytes_received()) / 1024 ) / 1024)); ?></span> <small>MB</small></li>
        <li>Trafic send: <span><?php echo \dash\fit::number((((\dash\data::mysqlInfo_Bytes_sent()) / 1024 ) / 1024)); ?></span> <small>MB</small></li>
      </div>

      <div class="btn-success block mb-2" data-confirm data-timeout=0 data-data='{"backupnow": "jibres"}'>Backup Jibres Database</div>


    </div>
  </div>



</div>

  <?php iShowFiles(); ?>

<?php } ?>











<?php function iShowFiles() {?>
<nav class="breadcrumb">
  <?php if(\dash\request::get('folder')) {?>

  <a href="<?php echo \dash\url::this(); ?>" tabindex="-1"><span class="fa fa-home"></span>All</a>
  <?php if(!\dash\request::get('subfolder')) {?>

  <a><?php echo \dash\request::get('folder'); ?></a>
  <?php } //endif ?>
  <?php } //endif ?>
  <?php if(\dash\request::get('subfolder') && \dash\request::get('folder')) {?>

  <a href="<?php echo \dash\url::this(); ?>?folder=<?php echo \dash\request::get('folder'); ?>" tabindex="-1"><span class="fa fa-home"></span><?php echo \dash\request::get('folder'); ?></a>
  <a><?php echo \dash\request::get('subfolder'); ?></a>
  <?php } //endif ?>

</nav>

<?php if(\dash\data::oldBackup()) {?>

<div class="ltr">

<table class="tbl1 v5">
<?php foreach (\dash\data::oldBackup() as $key => $value) {?>

<?php if(isset($value['type']) && $value['type'] == 'file') {?>

  <tr>
    <td class="text-left">
      <span class="sf-database fs15 mR10"></span>
      <a href="<?php echo \dash\url::here() . '/backup'. \dash\request::full_get(['download' => a($value, 'addr')]); ?>" data-direct title='<?php echo T_("Click to download"); ?>'><?php echo a($value, 'name'); ?></a>
    </td>
    <td class="rtl s0"><?php echo a($value, 'ago'); ?></td>
    <td class="pR25-f rtl s0"><?php echo \dash\fit::number(a($value, 'size')); ?> <?php echo T_("MB"); ?></td>

  </tr>
<?php }elseif(isset($value['type']) && $value['type'] == 'folder') {?>

  <tr>
    <td class="text-left">
      <span class="sf-folder fs15 mR10"></span>
      <a href="<?php echo \dash\url::this(); ?>/?folder=<?php echo a($value, 'folder'); ?>&subfolder=<?php echo a($value, 'subfolder'); ?>"><?php echo a($value, 'name'); ?></a>
    </td>
    <td class="rtl s0 pR25-f"><i class="sf-briefcase"></i> <a target="_blank" href="<?php echo \dash\url::here() . '/backup'. \dash\request::full_get(['zipdownload' => a($value, 'addr')]); ?>" ><?php echo T_("Download zip"); ?></div></td>

  </tr>
<?php }//endif ?>
<?php } //endfor ?>
</table>
</div>

<?php }else{ ?>
<div class="alert-danger fs16"><?php echo T_("No backup was found"); ?></div>
<?php } ?>



<?php }//endfunction ?>














<?php function iEvery() {?>
<label for="every"><?php echo T_("Start backup every"); ?></label>
<select name="every" id="every" class="select">
  <option value="year" <?php if(\dash\data::configBackup_every() == 'year') {echo 'selected';}?> ><?php echo T_("Year"); ?></option>
  <option value="month" <?php if(\dash\data::configBackup_every() == 'month') {echo 'selected';}?> ><?php echo T_("Month"); ?></option>
  <option value="week" <?php if(\dash\data::configBackup_every() == 'week') {echo 'selected';}?> ><?php echo T_("Week"); ?></option>
  <option value="day" <?php if(\dash\data::configBackup_every() == 'day') {echo 'selected';}?> ><?php echo T_("Day"); ?></option>
  <option value="hour" <?php if(\dash\data::configBackup_every() == 'hour') {echo 'selected';}?> ><?php echo T_("hour"); ?></option>
</select>
<?php }//endfunction ?>

<?php function iStartAtTime() {?>
<label for="time"><?php echo T_("Start backup at time"); ?></label>
<select name="time" id="time" class="select">
  <option value="00" <?php if(\dash\data::configBackup_time() == '00') {echo 'selected';} ?> ><?php echo \dash\fit::number('00'); ?></option>
  <option value="01" <?php if(\dash\data::configBackup_time() == '01') {echo 'selected';} ?> ><?php echo \dash\fit::number('01'); ?></option>
  <option value="02" <?php if(\dash\data::configBackup_time() == '02') {echo 'selected';} ?> ><?php echo \dash\fit::number('02'); ?></option>
  <option value="03" <?php if(\dash\data::configBackup_time() == '03') {echo 'selected';} ?> ><?php echo \dash\fit::number('03'); ?></option>
  <option value="04" <?php if(\dash\data::configBackup_time() == '04') {echo 'selected';} ?> ><?php echo \dash\fit::number('04'); ?></option>
  <option value="05" <?php if(\dash\data::configBackup_time() == '05') {echo 'selected';} ?> ><?php echo \dash\fit::number('05'); ?></option>
  <option value="06" <?php if(\dash\data::configBackup_time() == '06') {echo 'selected';} ?> ><?php echo \dash\fit::number('06'); ?></option>
  <option value="07" <?php if(\dash\data::configBackup_time() == '07') {echo 'selected';} ?> ><?php echo \dash\fit::number('07'); ?></option>
  <option value="08" <?php if(\dash\data::configBackup_time() == '08') {echo 'selected';} ?> ><?php echo \dash\fit::number('08'); ?></option>
  <option value="09" <?php if(\dash\data::configBackup_time() == '09') {echo 'selected';} ?> ><?php echo \dash\fit::number('09'); ?></option>
  <option value="10" <?php if(\dash\data::configBackup_time() == '10') {echo 'selected';} ?> ><?php echo \dash\fit::number('10'); ?></option>
  <option value="11" <?php if(\dash\data::configBackup_time() == '11') {echo 'selected';} ?> ><?php echo \dash\fit::number('11'); ?></option>
  <option value="12" <?php if(\dash\data::configBackup_time() == '12') {echo 'selected';} ?> ><?php echo \dash\fit::number('12'); ?></option>
  <option value="13" <?php if(\dash\data::configBackup_time() == '13') {echo 'selected';} ?> ><?php echo \dash\fit::number('13'); ?></option>
  <option value="14" <?php if(\dash\data::configBackup_time() == '14') {echo 'selected';} ?> ><?php echo \dash\fit::number('14'); ?></option>
  <option value="15" <?php if(\dash\data::configBackup_time() == '15') {echo 'selected';} ?> ><?php echo \dash\fit::number('15'); ?></option>
  <option value="14" <?php if(\dash\data::configBackup_time() == '14') {echo 'selected';} ?> ><?php echo \dash\fit::number('14'); ?></option>
  <option value="17" <?php if(\dash\data::configBackup_time() == '17') {echo 'selected';} ?> ><?php echo \dash\fit::number('17'); ?></option>
  <option value="19" <?php if(\dash\data::configBackup_time() == '19') {echo 'selected';} ?> ><?php echo \dash\fit::number('19'); ?></option>
  <option value="20" <?php if(\dash\data::configBackup_time() == '20') {echo 'selected';} ?> ><?php echo \dash\fit::number('20'); ?></option>
  <option value="21" <?php if(\dash\data::configBackup_time() == '21') {echo 'selected';} ?> ><?php echo \dash\fit::number('21'); ?></option>
  <option value="22" <?php if(\dash\data::configBackup_time() == '22') {echo 'selected';} ?> ><?php echo \dash\fit::number('22'); ?></option>
  <option value="23" <?php if(\dash\data::configBackup_time() == '23') {echo 'selected';} ?> ><?php echo \dash\fit::number('23'); ?></option>
</select>
<?php }//endfunction ?>


<?php function iLifeTime() {?>
<label for="life_time"><?php echo T_("Life time of old backup"); ?></label>
<select name="life_time" id="life_time" class="select">
  <option value="year2" <?php if(\dash\data::configBackup_life_time() == 'year2') {echo 'selected';} ?> ><?php echo T_("2 years"); ?></option>
  <option value="year" <?php if(\dash\data::configBackup_life_time() == 'year') {echo 'selected';} ?> ><?php echo T_("one year"); ?></option>
  <option value="month6" <?php if(\dash\data::configBackup_life_time() == 'month6') {echo 'selected';} ?> ><?php echo T_("6 months"); ?></option>
  <option value="month3" <?php if(\dash\data::configBackup_life_time() == 'month3') {echo 'selected';} ?> ><?php echo T_("3 months"); ?></option>
  <option value="month2" <?php if(\dash\data::configBackup_life_time() == 'month2') {echo 'selected';} ?> ><?php echo T_("2 months"); ?></option>
  <option value="month" <?php if(\dash\data::configBackup_life_time() == 'month') {echo 'selected';} ?> ><?php echo T_("one month"); ?></option>
  <option value="week" <?php if(\dash\data::configBackup_life_time() == 'week') {echo 'selected';} ?> ><?php echo T_("one week"); ?></option>
  <option value="week2" <?php if(\dash\data::configBackup_life_time() == 'week2') {echo 'selected';} ?> ><?php echo T_("2 weeks"); ?></option>
  <option value="day" <?php if(\dash\data::configBackup_life_time() == 'day') {echo 'selected';} ?> ><?php echo T_("one day"); ?></option>
  <option value="day3" <?php if(\dash\data::configBackup_life_time() == 'day3') {echo 'selected';} ?> ><?php echo T_("3 days"); ?></option>
  <option value="day5" <?php if(\dash\data::configBackup_life_time() == 'day5') {echo 'selected';} ?> ><?php echo T_("5 days"); ?></option>
</select>
<?php }//endfunction ?>