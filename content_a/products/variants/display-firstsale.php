<div class="avand-md">
	<div class="box">
		<div class="body">
			<p class="msg warn2">
				<?php echo T_("Can not set variants after sale, buy or any factor type of this products"); ?>
			</p>
		</div>
		<footer class="txtRa">
			<a class="btn link" href="<?php echo \dash\url::here(). '/order?product='. \dash\data::productDataRow_id(); ?>"><?php echo T_("Show list of order contain this product") ?></a>

		</footer>
	</div>
</div>