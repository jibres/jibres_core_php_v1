<nav class="items">
	<ul>
		<?php foreach (\dash\data::dataTable() as $key => $value) {?>
			<li>
				<div class="f align-center">

					<div class="key"><?php echo a($value, 'title'); ?></div>

					<div class="spay-32-<?php echo a($value, 'payment'); ?> key cauto"></div>
					<div class="key font-bold ltr"><?php if(isset($value['plus']) && $value['plus']) {?><b>+<?php echo \dash\fit::price($value['plus']); ?></b><?php }?><?php if(isset($value['minus']) && $value['minus']) {?><b>-<?php echo \dash\fit::price($value['minus']); ?></b><?php }?></div>

					<div class="value datetime s0"><?php echo \dash\fit::date_time($value['date']); ?></div>
					<div class="go detail s0"></div>
				</div>
			</li>
		<?php } //endfor ?>
	</ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
