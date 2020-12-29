<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-md">
	<a target="_blank" href="<?php echo a($dataRow, 'path') ?>">
		<img src="<?php echo a($dataRow, 'thumb'); ?>" alt="<?php echo a($dataRow, 'title') ?>">
	</a>
	<nav class="items long">
		<ul>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Title") ?></div>
					<div class="value"><?php echo a($dataRow, 'filename') ?></div>
				</a>
			</li>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Type") ?></div>
					<div class="value"><?php echo a($dataRow, 't_type') ?></div>
				</a>
			</li>
			<li>
				<a class="f item" data-copy="<?php echo a($dataRow, 'path') ?>">
					<div class="key"><?php echo T_("Path") ?></div>
					<div class="value"><?php echo a($dataRow, 'path') ?></div>
				</a>
			</li>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("size") ?></div>
					<div class="value"><?php echo \dash\fit::file_size(a($dataRow, 'size')) ?></div>
				</a>
			</li>
			<?php if(a($dataRow, 'totalsize') && a($dataRow, 'size') !== a($dataRow, 'totalsize')) {?>
			<li>
				<a class="f item" href="<?php echo \dash\url::this(). '/images'. \dash\request::full_get() ?>">
					<div class="key"><?php echo T_("Total size") ?></div>
					<div class="value"><?php echo \dash\fit::file_size(a($dataRow, 'totalsize')) ?></div>
					<div class="go"></div>
				</a>
			</li>
			<?php } //endif ?>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Date created") ?></div>
					<div class="value"><?php echo \dash\fit::date_time(a($dataRow, 'datecreated')) ?></div>
				</a>
			</li>
			<?php if(\dash\data::usageCount()) {?>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Usage count") ?></div>
					<div class="value"><?php echo \dash\fit::number(\dash\data::usageCount()) ?></div>
				</a>
			</li>

			<?php } //endif ?>
		</ul>
	</nav>
	<nav class="items long">
		<ul>
			<li>
				<a data-confirm data-data='{"remove": "remove"}' class="f item">
					<div class="key"><?php echo T_("Remove file") ?></div>
					<div class="value"><i class="sf-trash fc-red"></i></div>
				</a>
			</li>
		</ul>
	</nav>

</div>
