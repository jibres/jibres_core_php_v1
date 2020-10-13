<form method="get" autocomplete="off" action="<?php echo \dash\url::this() ?>">
	<input type="hidden" name="id" value="<?php echo \dash\data::productDataRow_id() ?>">
<div class="box">
	<div class="pad">
		<div class="msg">
			<div class="f">
				<div class="c s12"><?php echo \dash\data::productDataRow_title(); ?></div>
				<div class="c s12"><?php if(\dash\data::productDataRow_price()) { echo T_("Price"). ' '. \dash\fit::number(\dash\data::productDataRow_price()); } //endif ?></div>
				<div class="cauto"><a class="btn secondary" href="<?php echo \dash\url::here(); ?>/products/edit?id=<?php echo \dash\data::productDataRow_id(); ?>"><?php echo T_("Edit"); ?></a></div>
			</div>
		</div>

		<?php if(\dash\data::productDataRow_datecreated()) {?>
			<div class="row">
				<div class="c-md-6"><div title="<?php echo \dash\data::productDataRow_datecreated(); ?>" class="msg"><?php echo T_("Date created") ?>: <span class="txtL ltr compact"><?php echo \dash\fit::date_time(\dash\data::productDataRow_datecreated()); ?></span></div></div>
				<div class="c-md-6"><div title="<?php echo \dash\data::productDataRow_datemodified(); ?>" class="msg"><?php echo T_("Date modified") ?>: <span class="txtL ltr compact"><?php echo \dash\fit::date_time(\dash\data::productDataRow_datemodified()); ?></span></div></div>
			</div>
		<?php }//endif ?>

		<label for="date" ><?php echo T_("Show Price in special date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
		<div class="input">
		<input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="date" id="date" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off'>
		<button class="addon btn"><?php echo T_("Go") ?></button>
		</div>




<?php if(\dash\data::specialDate()) {?>

<h4><?php echo T_("Show change price in special date"); ?></h4>
<div class="tblBox">
	<table class="tbl1 v1">
		<thead>
			<tr>
				<th><?php echo T_("Start date"); ?></th>
				<th><?php echo T_("End date"); ?></th>
				<th><?php echo T_("Buy price"); ?></th>
				<th><?php echo T_("Price"); ?></th>
				<th><?php echo T_("Discount"); ?></th>
				<th><?php echo T_("Final price"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (\dash\data::specialDate() as $key => $value) {?>

				<tr>
					<td><?php echo \dash\fit::date(\dash\get::index($value, 'startdate')); ?></td>
					<td><?php echo \dash\fit::date(\dash\get::index($value, 'enddate')); ?></td>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'buyprice')); ?></td>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></td>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'discount')); ?></td>
					<td><?php echo \dash\fit::number(\dash\get::index($value, 'finalprice')); ?></td>
				</tr>
			<?php } //endfor ?>
		</tbody>

	</table>
</div>
<?php } //endif ?>


	</div>

</div>
</form>




<div id="chartdiv" class="chart x400" data-abc='a/pricehistory'></div>


<div class="hide">
	<div id="charttitle"><?php echo T_("Price change in time line"); ?></div>
	<div id="chartcategory"><?php echo \dash\data::cahrtDetail_categories(); ?></div>
	<div id="charttitleprice"><?php echo T_("Price"); ?></div>
	<div id="chartseries"><?php echo \dash\data::cahrtDetail_data(); ?></div>
</div>
