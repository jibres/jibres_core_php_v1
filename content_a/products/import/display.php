

<p class="msg info2 fs14"><?php echo T_("Importing products is useful if you switched to Jibres from another platform."); ?> <?php echo T_("When importing, Jibres converts the data from the CSV file into products."); ?></p>

<p class="msg info2 fs14"><?php echo T_("If you want to transfer a large amount of product information between Jibres and another system, then you can use a specially-formatted spreadsheet to import or export that data."); ?> <?php echo T_("Jibres uses CSV (comma-separated value) files to perform this kind of bulk task."); ?></p>

<p class="msg info2 fs14"><?php echo T_("Importing a CSV file that has been sorted by a spreadsheet editor such as Microsoft Excel or Numbers might cause your products to be removed from their relevant image links on the CSV, and your product's images will be lost."); ?></p>

<p class="msg danger2 fs14"><?php echo T_("Before you start your import, make sure that you have a backup of your product data."); ?></p>

<div class="cbox">
	<ul>
		<li><?php echo T_("The maximum file size is 5 MB."); ?></li>
		<li><?php echo T_("Only 1,000 products are accepted in each file"); ?>.</li>
		<?php if(\dash\data::awaitingImport()) {?>

		<li><?php echo T_("Posting a new file will delete the previously reviewed file"); ?>.</li>

		<?php } //endif ?>
	</ul>
	<form method="post" autocomplete="off" action="<?php echo \dash\url::that(); ?>">
		<label for="import"><?php echo T_("Csv file"); ?></label>
		<div class="input w300">
			<input type="file" name="import" accept=".csv" id="import">
		</div>
		<button class="btn success"><?php echo T_("Check file"); ?></button>
	</form>
</div>

<?php if(\dash\data::awaitingImport()) {?>

<?php
$awaitingImport = \dash\data::awaitingImport();

?>

<div class="cbox">
	<h4><?php echo T_("Result analysis file"); ?></h4>
	<?php if(isset($awaitingImport['meta']['avalible_count']) && $awaitingImport['meta']['avalible_count']) {?>

		<div class="msg success2 f"><?php echo T_("Count Record available to import:"); ?> <b class="c mLa10 s12"><?php echo \dash\fit::number($awaitingImport['meta']['avalible_count']); ?></b></div>
	<?php }//endif ?>

	<?php if(isset($awaitingImport['meta']['allErrorCount']) && $awaitingImport['meta']['allErrorCount']) {?>

		<div class="msg danger f"><?php echo T_("Count Record found whit error:"); ?> <b class="c mLa10 s12"><?php echo \dash\fit::number($awaitingImport['meta']['allErrorCount']); ?></b></div>
		<div class="">

		<?php if(isset($awaitingImport['meta']['error']) && $awaitingImport['meta']['error'] && is_array($awaitingImport['meta']['error'])) {?>

			<?php foreach ($awaitingImport['meta']['error'] as $key => $value) {?>

			<div class="msg danger2">
				<div class="f">
					<div class="c s12"><small><?php echo T_("Error"); ?></small>: <?php echo \dash\get::index($value, 'msg'); ?></div>
					<div class="c s12"><small><?php echo T_("Count error"); ?></small> <b><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></b></div>
					<?php if(isset($value['index']) && is_array($value['index']) && count($value['index']) > 5) {?>

						<div class="c s12"><small data-copy="#error<?php echo $key; ?>"><?php echo T_("Error in index records"); ?></small>
							<textarea class="txt" rows="2" id="error<?php echo $key; ?>"><?php echo implode(',', $value['index']); ?></textarea>
						</div>

					<?php }else{ ?>

						<div class="c s12"><small><?php echo T_("Error in index record"); ?></small> <b>php<?php echo @implode(',', \dash\get::index($value, 'index')); ?></b></div>

					<?php } //endif ?>
				</div>
			</div>

			<?php }//endfor ?>

		<?php }//endif ?>
		</div>
	<?php }//endif ?>

	<?php if(isset($awaitingImport['meta']['overwrite_count']) && $awaitingImport['meta']['overwrite_count']) {?>

		<div class="msg warn2">
			<?php echo T_("Your input file contains a number of records that have ID, and if you import this file your existing products by this ids will be replaced with new data"); ?>
			<br>
			<?php echo T_("Count record have ID"); ?> <b><?php echo \dash\fit::number($awaitingImport['meta']['overwrite_count']); ?></b>
			<br>
			<small data-copy="#haveId"><?php echo T_("Founded id"); ?></small>
			<textarea class="txt" rows="2" id="haveId"><?php @implode(',', \dash\get::index($awaitingImport, 'meta', 'overwrite')); ?></textarea>

		</div>
	<?php } //endif ?>

	<div class="txtRa">

	<div class="btn secondary" data-ajaxify data-data='{"cancel": "cancel"}' data-method='post'><?php echo T_("Never mind"); ?></div>
	<?php if(!\dash\get::index($awaitingImport, 'meta', 'allErrorCount')) {?>


		<?php if(\dash\get::index($awaitingImport, 'meta', 'overwrite_count')) {?>

			<div class="btn warn" data-confirm data-data='{"import": "ok"}'><?php echo T_("I sure. I want to overwrite that products"); ?></div>
		<?php }else{ ?>

			<div class="btn success" data-confirm data-data='{"import": "ok"}'><?php echo T_("Import"); ?></div>
		<?php } //endif ?>

	<?php }//endif ?>

	</div>



</div>
<?php } //endif ?>

<img class="banner w300" src="<?php echo \dash\url::cdn(); ?>/img/product/import1.gif" align='<?php echo T_("import products"); ?>'>

