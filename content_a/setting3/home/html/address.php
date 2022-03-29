<?php
$store_data = \lib\store::detail('store_data');
\dash\data::dataRow($store_data);
?>
<form method="post" autocomplete="off" data-patch>
	<div class="avand-md">
		<div class="box">
			<div class="pad">
				<?php echo \content_a\setting3\home\view::switcher('set_address', true) ?>
				<p><?php echo T_("Based on your country some of our options will be changed."); ?></p>
				<?php echo \dash\utility\location::pack(\dash\data::dataRow_country(), \dash\data::dataRow_province(), \dash\data::dataRow_city()); ?>
				<label for="address"><?php echo T_("Address"); ?></label>
				<textarea class="txt mb-2 pB25" name="address" id="address" maxlength='300' rows="2"><?php echo \dash\data::dataRow_address(); ?></textarea>

				<label for="postcode"><?php echo T_("Post code"); ?></label>
				<div class="input">
					<input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRow_postcode(); ?>" data-format="postalCode">
				</div>

				<label for="iphone"><?php echo T_("Phone"); ?></label>
				<div class="input">
					<input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRow_phone(); ?>" data-format="tel">
				</div>
			</div>
		</div>
	</div>
</form>
