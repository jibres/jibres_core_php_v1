
<?php if(\dash\data::needUpgrade()) {?>
<?php
$needUpgrade = \dash\data::needUpgrade();

?>

  <div class="alert-danger fs14">
  <p><?php echo T_("Database need to upgrade"); ?></p>
   <div class="f">

    <?php if(isset($needUpgrade['jibres']) && $needUpgrade['jibres']) {?>
      <div class="c">
        <span class="font-bold"><?php echo T_("Jibres"); ?></span>
         <span><?php echo T_("current version"); ?> <b><?php echo a($needUpgrade, 'jibres', 'current'); ?></b></span> >>>
         <span><?php echo T_("new version"); ?> <b><?php echo a($needUpgrade, 'jibres', 'upgrade'); ?></b></span>
      </div>
    <?php } //endif ?>

    <?php if(isset($needUpgrade['store']) && $needUpgrade['store']) {?>
      <div class="c">
        <span class="font-bold"><?php echo T_("Business"); ?></span>
         <span><?php echo T_("current version"); ?> <b><?php echo a($needUpgrade, 'store', 'current'); ?></b></span> >>>
         <span><?php echo T_("new version"); ?> <b><?php echo a($needUpgrade, 'store', 'upgrade'); ?></b></span>
      </div>
    <?php } //endif ?>
   </div>
  </div>
<?php } //endif ?>

 <div class="box">
 	<div class="pad">
 		<?php echo T_("Current version") ?>
  <?php if(\dash\data::lastDBVersion_jibres()) { ?><span><?php echo T_("Jibres"); ?> <b><?php echo \dash\fit::text(\dash\data::lastDBVersion_jibres()) ?></b></span> / <?php } //endif ?>
  <?php if(\dash\data::lastDBVersion_store()) { ?><span><?php echo T_("Business"); ?> <b><?php echo \dash\fit::text(\dash\data::lastDBVersion_store()) ?></b></span> <?php } //endif ?>
 	</div>
</div>

<div class="box">
	<div class="pad">

	<div class="tblBox">
		<table class="tbl1 v1 ltr">
			<thead>
				<tr>
					<th class="text-left">Busienss</th>
					<th class="text-left">Databas Version</th>
					<th class="text-left">Last upgrade</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::allDatabaseVersion() as $key => $value) { ?>
					<tr class="text-left">
						<td class="text-left"><?php echo a($value, 'id') ?></td>
						<td class="text-left"><?php echo a($value, 'dbversion') ?></td>
						<td class="text-left"><?php echo \dash\fit::date_time(a($value, 'dbversiondate')) ?></td>
					</tr>
				<?php } //endfor ?>
			</tbody>
		</table>
	</div>
	</div>
</div>
