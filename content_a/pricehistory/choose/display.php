<form method="get" action="<?php echo \dash\url::this(); ?>" autocomplete="off" data-action>

	<div class="avand-md">
		<div class="box">
			<div class="pad mB50">
				<label for="productid"><?php echo T_("Choose product"); ?></label>
				<div>
					<select name="id" required class="select22" data-model='html'  <?php \dash\layout\autofocus::html() ?> data-default data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/sale'; ?>?json=true' data-placeholder='<?php echo T_("Search in products"); ?>'>
			      	</select>
				</div>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Go"); ?></button>
			</footer>
		</div>
	</div>
</form>