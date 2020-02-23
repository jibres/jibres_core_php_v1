

<div class="cbox p0">
	<form method="get" action="<?php echo \dash\url::this(); ?>" autocomplete="off" data-action>

		<?php if(\dash\request::get('oid')) {?>
			<input type="hidden" name="oid" value="<?php echo \dash\request::get('oid'); ?>">
		<?php } //endif ?>

		<?php if(\dash\request::get('id')) {?>
			<input type="hidden" name="oid" value="<?php echo \dash\request::get('id'); ?>">
		<?php } //endif ?>


		<label for="productid"><?php echo T_("Choose product"); ?></label>
		<select name="id" id="productid" class="ui dropdown search selection" data-source='<?php echo \dash\url::here(); ?>/sale?json=true&q={query}'>
			<option value=""><?php echo T_("Choose product"); ?></option>
		</select>

			<label for="date" ><?php echo T_("Show Price in special date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
			<div class="input">
			<input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="date" id="date" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off'>
			</div>


		<div class="txtRa">
			<button class="btn success mT10"><?php echo T_("Show chart"); ?></button>
		</div>
	</form>
</div>

<?php if(\dash\data::productDataRow()) {?>

<div class="msg fs14">
	<div class="f">
		<div class="c s12"><?php echo \dash\data::productDataRow_title(); ?></div>
		<div class="c s12"><?php if(\dash\data::productDataRow_price()) { echo T_("Price"). ' '. \dash\fit::number(\dash\data::productDataRow_price()); } //endif ?></div>
		<div class="cauto"><a class="btn secondary" href="<?php echo \dash\url::here(); ?>/products/edit?id=<?php echo \dash\data::productDataRow_id(); ?>"><?php echo T_("Edit"); ?></a></div>
	</div>
</div>
<?php } //endif ?>


<?php if(\dash\data::specialDate()) {?>

<h4><?php echo T_("Show change price in special date"); ?></h4>
<div class="tblBox">
	<table class="tbl1 v1 fs12">
		<thead>
			<tr>
				<th><?php echo T_("Buy price"); ?></th>
				<th><?php echo T_("Price"); ?></th>
				<th><?php echo T_("Discount"); ?></th>
				<th><?php echo T_("Final price"); ?></th>
				<th><?php echo T_("Start date"); ?></th>
				<th><?php echo T_("End date"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (\dash\data::specialDate() as $key => $value) {?>

				<tr>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'buyprice')); ?></td>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></td>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'discount')); ?></td>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'finalprice')); ?></td>
					<td><?php echo \dash\fit::date(\dash\get::index($value, 'startdate')); ?></td>
					<td><?php echo \dash\fit::date(\dash\get::index($value, 'enddate')); ?></td>
				</tr>
			<?php } //endfor ?>
		</tbody>

	</table>
</div>
<?php } //endif ?>


<div class="f justify-center">
	<div class="c11">
		<div id="chartdiv" class="chart"></div>
	</div>
</div>

<script>
<?php require_once(root. 'content_a/pricehistory/chart.js'); ?>
</script>

