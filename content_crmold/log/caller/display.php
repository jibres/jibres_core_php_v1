<div class="box">
	<div class="body">
		<div class="f">
			<?php foreach (\dash\data::dataTable() as $key => $value) {?>
				<div class="c3 fs14 mTB5">
					<div class="badge warn"><a class="link" href="<?php echo \dash\url::here(); ?>/log?caller=<?php echo $key; ?>"> <?php echo $key; ?></a></div>
					<div class="badge primary"><?php echo \dash\fit::number($value); ?></div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>