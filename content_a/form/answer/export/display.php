

<div class="msg info2 fs14">
<?php echo T_("You can export your form answer to a CSV file to help with several tasks."); ?>

</div>

<?php if(!\dash\data::countAll()) {?>
<p class="msg warn2 fs14"><?php echo T_("You have not any answer to export!"); ?></p>
<?php }else{ ?>
<div class="msg f fs14">
	<div class="cauto mLa5 s12"><?php echo T_("Answer count"); ?> <b><?php echo \dash\fit::number(\dash\data::countAll()); ?></b></div>
	<div class="c mLa5">
		<?php if(\dash\data::countAll() < 50) {?>
			<a href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>&download=now" class="mLa10"><?php echo T_("Download Now"); ?></a>
		<?php }elseif(\dash\data::countAll() >= 50) {?>
			<div class="btn link" data-confirm data-data='{"export":"answer"}' class="mLa10"><?php echo T_("Send export request"); ?></div>
		<?php } //endif ?>
	</div>
</div>

<?php if(\dash\data::exportList()) {?>

<h5><?php echo T_("Answer exported list"); ?></h5>
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

					<a href="<?php echo \dash\url::current(). '?id='. \dash\get::index($value, 'id'); ?>"><?php echo T_("Download"); ?></a>

					<?php } //endif ?>
				</div>
			</div>


		</div>
	<?php } //endfor ?>
</div>

<?php } //endif ?>

<?php } //endif ?>

<img class="banner w300" src="<?php echo \dash\url::cdn(); ?>/img/product/export1.png" align='<?php echo T_("import answers"); ?>'>

