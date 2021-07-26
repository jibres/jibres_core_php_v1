<?php

$thisQurarter = \dash\request::get('quarter');
if(!$thisQurarter)
{
	$thisQurarter = 1;
}

?>
<section class="row">
		<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'type' => 'costasset']); ?>" class="stat x70 <?php if(\dash\request::get('type') === 'costasset' || !\dash\request::get('type')) { echo 'active';} ?>">
			<h3><?php echo T_("Reprot on");?></h3>
			<div class="val"><?php echo T_("Cost + Asset");?></div>
		</a>
	</div>

	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'type' => 'income']); ?>" class="stat x70 <?php if(\dash\request::get('type') === 'income') { echo 'active';} ?>">
			<h3><?php echo T_("Reprot on");?></h3>
			<div class="val"><?php echo T_("Income");?></div>
		</a>
	</div>
</section>
<section class="row">

	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 1, 'type' => \dash\request::get('type')]); ?>" class="stat x70 <?php if($thisQurarter == '1' || !$thisQurarter) { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 1");?></h3>
			<div class="val"><?php echo T_("Spring");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 2, 'type' => \dash\request::get('type')]); ?>" class="stat x70 <?php if($thisQurarter == '2') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 2");?></h3>
			<div class="val"><?php echo T_("Summer");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 3, 'type' => \dash\request::get('type')]); ?>" class="stat x70 <?php if($thisQurarter == '3') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 3");?></h3>
			<div class="val"><?php echo T_("Autumn");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 4, 'type' => \dash\request::get('type')]); ?>" class="stat x70 <?php if($thisQurarter == '4') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 4");?></h3>
			<div class="val"><?php echo T_("Winter");?></div>
		</a>
	</div>
</section>
<div class="">
	<div class="tblBox fs12">
		<?php foreach (\dash\data::dataTable() as $key => $value) {
			if($thisQurarter && intval($thisQurarter) !== intval($key))
			{
				continue;
			}
			?>
			<?php if(!$thisQurarter) {?><hr><h2><?php echo T_("Quarter $key") ?></h2><?php } //endif ?>
			<table class="tbl1 v1 minimal">
				<thead>
					<tr>
						<th><?php echo T_("Description") ?></th>
						<th><?php echo T_("Date") ?></th>
						<th><?php echo T_("Template") ?></th>
						<th><?php echo T_("Serial Number") ?></th>
						<th><?php echo T_("Total") ?></th>
						<th><?php echo T_("Total discount") ?></th>
						<th><?php echo T_("Total vat") ?></th>
						<th><?php echo T_("Total include vat") ?></th>
						<th><?php echo T_("Total non-include vat") ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($value as $k => $v) { ?>
					<tr>
						<td><?php echo a($v, 'desc') ?></td>
						<td><?php echo \dash\fit::date(a($v, 'date')) ?></td>
						<td><?php echo \lib\app\tax\doc\ready::factor_type_translate(a($v, 'template')); ?></td>
						<td><?php echo a($v, 'serialnumber'); ?></td>
						<td data-copy='<?php echo a($v, 'total') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'total'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totaldiscount') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totaldiscount'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totalvat') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totalvat'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totalincludevat') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totalincludevat'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totalnotincludevat') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totalnotincludevat'), true, 'en') ?></code></td>
					</tr>
				<?php } //endif ?>

				</tbody>
			</table>
		<?php } //endfor ?>
	</div>
</div>