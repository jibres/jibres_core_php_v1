
	<section class="row">
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'type' => \dash\request::get('type'), 'detail' => null]); ?>" class="stat x70 <?php if(!\dash\request::get('detail') ) { echo 'active';} ?>">
			<h3><?php echo T_("The whole year");?></h3>
			<div class="val"><?php echo T_("Summary");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 1, 'type' => \dash\request::get('type'), 'detail' => 1]); ?>" class="stat x70 <?php if($thisQurarter == '1' || !$thisQurarter) { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 1");?></h3>
			<div class="val"><?php echo T_("Spring");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 2, 'type' => \dash\request::get('type'), 'detail' => 1]); ?>" class="stat x70 <?php if($thisQurarter == '2') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 2");?></h3>
			<div class="val"><?php echo T_("Summer");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 3, 'type' => \dash\request::get('type'), 'detail' => 1]); ?>" class="stat x70 <?php if($thisQurarter == '3') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 3");?></h3>
			<div class="val"><?php echo T_("Autumn");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 4, 'type' => \dash\request::get('type'), 'detail' => 1]); ?>" class="stat x70 <?php if($thisQurarter == '4') { echo 'active';} ?>">
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
						<th><?php echo T_("Company National ID") ?></th>
						<th><?php echo T_("Company E-conomic code") ?></th>
						<th><?php echo T_("Description") ?></th>

						<th><?php echo T_("Total") ?></th>
						<th><?php echo T_("Total discount") ?></th>
						<th><?php echo T_("Vat 6%") ?></th>
						<th><?php echo T_("Vat 3%") ?></th>
						<th><?php echo T_("Seller") ?></th>
						<th class="collapsing"><?php echo T_("Detail") ?></th>

					</tr>
				</thead>
				<tbody>
				<?php foreach ($value as $k => $v) { ?>
					<tr>
						<td data-copy='<?php echo a($v, 'user_detail', 'companynationalid'); ?>'><?php echo a($v, 'user_detail', 'companynationalid'); ?></td>
						<td data-copy='<?php echo a($v, 'user_detail', 'companyeconomiccode'); ?>'><?php echo a($v, 'user_detail', 'companyeconomiccode'); ?></td>
						<td data-copy='<?php echo a($v, 'producttitle'); ?>'><?php echo a($v, 'producttitle'); ?></td>
						<td class="font-12 ltr txtR">
							<code data-copy='<?php echo a($v, 'total') ?>'><?php echo \dash\fit::number(a($v, 'total'), true, 'en') ?></code>
						</td>

						<td data-copy='<?php echo a($v, 'totaldiscount') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totaldiscount'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totalvat6') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totalvat6'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totalvat3') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totalvat3'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'user_detail', 'companyname'); ?>'><?php echo a($v, 'user_detail', 'companyname'); ?></td>
						<td class="collapsing"><?php if(!a($v, 'merged')) { ?><a class="link txtB " href="<?php echo \dash\url::current(). \dash\request::full_get(['fid' => a($v, 'id')]) ?>"><?php echo T_("Detail") ?></a><?php } //endif ?></td>
					</tr>
				<?php } //endif ?>
				</tbody>
			</table>
		<?php } //endfor ?>
	</div>
</div>