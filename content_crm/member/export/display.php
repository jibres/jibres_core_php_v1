
<p class="alert-info fs14"><?php echo T_("If you want to transfer a large amount of member information between Jibres and another system, then you can use a specially-formatted spreadsheet to import or export that data."); ?> <?php echo T_("Jibres uses CSV (comma-separated value) files to perform this kind of bulk task."); ?></p>

<p class="msg primary2 fs14"><?php echo T_("If you export up to 50 members, then the CSV file is downloaded by your browser. If you export 51 or more members, then the CSV file is emailed to you."); ?> <?php echo T_("If you aren't the store owner, then the file is sent to the store owner's email as well."); ?></p>

<?php if(!\dash\data::countAll()) {?>

<p class="alert-warning fs14"><?php echo T_("You have not any member to export!"); ?>
	<a href="<?php echo \dash\url::here(); ?>/members/add"><?php echo T_("Add new member"); ?></a>
</p>

<?php }else{ ?>

<div class="msg f fs14">
	<div class="cauto mLa5 s12"><?php echo T_("Member count"); ?> <b><?php echo \dash\fit::number(\dash\data::countAll()); ?></b></div>
	<div class="c mLa5">
		<?php if(\dash\data::countAll() < 50) {?>

			<a data-direct href="<?php echo \dash\url::that(); ?>?download=now" class="mLa10"><?php echo T_("Download Now"); ?></a>
		<?php }elseif(\dash\data::countAll() >= 50) {?>

			<a href="<?php echo \dash\url::that(); ?>" data-confirm data-data='{"export":"member"}' class="mLa10"><?php echo T_("Send export request"); ?></a>

		<?php } //endif ?>
	</div>
</div>

<?php if(\dash\data::exportList()) {?>

<h5><?php echo T_("Member exported list"); ?></h5>
<div class="f fs12">

	<?php foreach (\dash\data::exportList() as $key => $value) {?>


		<div class="mLa10 c5 m12 s12">
			<div class="f msg align-center">
				<div class="cauto mRa10"><i class="sf-database fs14 fc-green"></i></div>
				<div class="c sauto"><?php echo \dash\fit::date($value['datecreated']); ?></div>
				<div class="c s12"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
				<?php if(isset($value['status']) && $value['status'] == 'request') {?>

				<div class="c s12"><?php echo T_("Waiting to complete process..."); ?></div>

				<?php }else{ ?>

				<div class="c s12"><small><?php echo T_("Status"); ?></small> <b><?php echo $value['tstatus']; ?></b></div>

				<?php }//endif ?>

				<div class="cauto mLa5">
					<?php if(isset($value['status']) && $value['status'] == 'done') {?>

					<a download href="<?php echo a($value, 'download_link'); ?>"><?php echo T_("Download"); ?></a>

					<?php } //endif ?>
				</div>
			</div>


		</div>
	<?php } //endfor ?>
</div>

<?php } //endif ?>

<?php } //endif ?>

<img class="banner w300" src="<?php echo \dash\url::cdn(); ?>/img/product/export1.png" align='<?php echo T_("import members"); ?>'>

