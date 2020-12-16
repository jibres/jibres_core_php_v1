<?php $dataRow = \dash\data::dataRow(); ?>
<form method="post">
	<div class="row justify-center">
		<div class="c-xs-12 c-sm-6">
			<a target="_blank" href="<?php echo a($dataRow, 'path') ?>">
				<img src="<?php echo a($dataRow, 'thumb'); ?>" alt="<?php echo a($dataRow, 'title') ?>">
			</a>
			<nav class="items">
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
							<div class="value"><?php echo a($dataRow, 'type') ?></div>
						</a>
					</li>
					<li>
						<a class="f item">
							<div class="key"><?php echo T_("path") ?></div>
							<div class="value"><?php echo a($dataRow, 'path') ?></div>
						</a>
					</li>
					<li>
						<a class="f item">
							<div class="key"><?php echo T_("size") ?></div>
							<div class="value"><?php echo \dash\fit::file_size(a($dataRow, 'size')) ?></div>
						</a>
					</li>
					<li>
						<a class="f item">
							<div class="key"><?php echo T_("Date created") ?></div>
							<div class="value"><?php echo \dash\fit::date_time(a($dataRow, 'datecreated')) ?></div>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</form>