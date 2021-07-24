<div class="avand-md">
	<form method="post" autocomplete="off">
		<div class="box">
			<div class="pad">

				<label for="remainvatlastyear"><?php echo T_("Accounting remain VAT price from last year") ?></label>
				<div class="input">
					<input type="tel" name="remainvatlastyear" id="remainvatlastyear" value="<?php echo \dash\fit::number_en(\dash\data::dataRow_remainvatlastyear()); ?>" data-format="price">
				</div>

				<label for="quorumprice"><?php echo T_("The amount of the tax quorumprice") ?></label>
				<div class="input">
					<input type="tel" name="quorumprice" id="quorumprice" value="<?php echo \dash\fit::number_en(\dash\data::dataRow_quorumprice()); ?>" data-format="price">
				</div>


			</div>
			<footer class="txtRa">
				<button class="btn success"><?php echo T_("Save") ?></button>
			</footer>
		</div>

	</form>
</div>