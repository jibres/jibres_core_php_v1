<?php

$thisQurarter = \dash\request::get('quarter');
if(!$thisQurarter)
{
	$thisQurarter = 1;
}

$quorumprice = floatval(\dash\data::dataRow_quorumprice());

?>
<?php if(!\dash\request::get('detail')) {?>
<div class="row">
  <?php foreach(\dash\data::dataTable() as $key => $value) {
  	$link = \dash\url::current(). \dash\request::full_get(['detail' => 1, 'quarter' => $key]);
  	?>
  <div class="c-xs-12 c-sm-12 c-md-3">
    <p class="mB5-f font-14"><?php echo a($value, 'title'); ?></p>
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo $link ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="report" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Total") ?></div>
            <div class="value" data-copy='<?php echo a($value, 'total') ?>'><?php echo \dash\fit::number(a($value, 'total')) ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo $link ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="report" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Total discount") ?></div>
            <div class="value" data-copy='<?php echo a($value, 'totaldiscount') ?>'><?php echo \dash\fit::number(a($value, 'totaldiscount')) ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo $link ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="report" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Total vat 6%") ?></div>
            <div class="value" data-copy='<?php echo a($value, 'totalvat6') ?>'><?php echo \dash\fit::number(a($value, 'totalvat6')) ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo $link ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" alt="report" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Total vat 3%") ?></div>
            <div class="value" data-copy='<?php echo a($value, 'totalvat3') ?>'><?php echo \dash\fit::number(a($value, 'totalvat3')) ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>
  </div>
<?php } //endfor ?>
</div>
<?php }else{ ?>
	<section class="row">
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'type' => \dash\request::get('type'), 'detail' => null]); ?>" class="stat x70 <?php if(!\dash\request::get('detail') ) { echo 'active';} ?>">
			<h3><?php echo T_("Total year");?></h3>
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
						<th><?php echo T_("Description") ?></th>
						<th><?php echo T_("Date") ?></th>
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
						<td><?php echo a($v, 'desc'); ?></td>
						<td><?php echo \dash\fit::date(a($v, 'date')) ?></td>
						<td class="font-12 ltr txtR">
							<code data-copy='<?php echo a($v, 'total') ?>'><?php echo \dash\fit::number(a($v, 'total'), true, 'en') ?></code>
								<?php if(\dash\request::get('merge') && a($v, 'merged')) {?>
									<a href="<?php echo \dash\url::current(). \dash\request::full_get(['merge' => 0]) ?>" class="badge primary"><?php echo T_("Split") ?></a>
								<?php } //endif ?>
							<?php if(floatval(a($v, 'total')) < $quorumprice && !\dash\request::get('merge')) {?>
									<a href="<?php echo \dash\url::current(). \dash\request::full_get(['merge' => 1]) ?>" class="badge "><?php echo T_("Merge") ?></a>
							<?php } //endif ?>
						</td>
						<td data-copy='<?php echo a($v, 'totaldiscount') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totaldiscount'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totalvat') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totalvat'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totalincludevat') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totalincludevat'), true, 'en') ?></code></td>
						<td data-copy='<?php echo a($v, 'totalnotincludevat') ?>' class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a($v, 'totalnotincludevat'), true, 'en') ?></code></td>
					</tr>
					<?php if(a($v, 'desc_merge')) {?>
						<tr>
							<td colspan="7"><?php echo a($v, 'desc_merge'); ?></td>
						</tr>
					<?php } //endif ?>
				<?php } //endif ?>
				</tbody>
			</table>
		<?php } //endfor ?>
	</div>
</div>
<?php } //endif ?>
