<form method="post" autocomplete="off">
	<div class="avand-md">
		<div class="box">
			<header><h2><?php echo \dash\face::title(); ?></h2></header>
			<div class="body">
				<p><?php echo T_("Selling physical products? You need to ship them!"); ?></p>

				<div class="switch1 mT10">
					<input type="checkbox" name="deliverinstoreplace" id="shippingdeliverinstoreplace" <?php if(\dash\data::shippingSettingSaved_deliverinstoreplace()) { echo 'checked'; } ?>>
					<label for="shippingdeliverinstoreplace"></label>
					<label for="shippingdeliverinstoreplace"><?php echo T_("Deliver in store place?"); ?></label>
				</div>

				<div class="switch1 mT10">
					<input type="checkbox" name="shipping_status" id="shipping-status" <?php if(\dash\data::shippingSettingSaved_shipping_status()) { echo 'checked'; } ?>>
					<label for="shipping-status"></label>
					<label for="shipping-status"><?php echo T_("Do you have shipping?"); ?></label>
				</div>

				<div data-response='shipping_status'  <?php if(!\dash\data::shippingSettingSaved_shipping_status()) {echo 'data-response-hide'; }  ?>>

					<br>
					<?php if(!\dash\data::storeCurrency()) {?>
						<div class="msg"><?php echo T_("To set your business currency") ?> <a class="btn link" href="<?php echo \dash\url::this(). '/units' ?>"><?php echo T_("Click here") ?></a></div>
					<?php } //endif ?>


					<div class="switch1 mT10">
						<input type="checkbox" name="sendbypost" id="sendbypost" <?php if(\dash\data::shippingSettingSaved_sendbypost()) { echo 'checked'; } ?>>
						<label for="sendbypost"></label>
						<label for="sendbypost"><?php echo T_("Send by post?"); ?></label>
					</div>
					<div data-response='sendbypost' <?php if(!\dash\data::shippingSettingSaved_sendbypost()) {echo 'data-response-hide'; }  ?> >
						<div class="input">
							<input type="text" name="sendbypostprice" id="sendbypostprice" placeholder="<?php echo T_("Shipping cost") ?>" value="<?php echo \dash\data::shippingSettingSaved_sendbypostprice(); ?>" data-format="price" maxlength="12">
							<label for="sendbypostprice" class="addon"><?php echo \dash\data::storeCurrency(); ?></label>
						</div>

						<div class="switch1 mT10">
							<input type="checkbox" name="freeshipping" id="freeshipping" <?php if(\dash\data::shippingSettingSaved_freeshipping()) { echo 'checked'; } ?>>
							<label for="freeshipping"></label>
							<label for="freeshipping"><?php echo T_("Have free shipping?"); ?></label>
						</div>
						<div data-response='freeshipping' <?php if(!\dash\data::shippingSettingSaved_freeshipping()) {echo 'data-response-hide'; }  ?> >
							<div class="input">
								<input type="text" name="freeshippingprice" id="freeshippingprice" placeholder="<?php echo T_("Shipping larger than this value is free") ?>" value="<?php echo \dash\data::shippingSettingSaved_freeshippingprice(); ?>" data-format="price" maxlength="12">
								<label for="sendbypostprice" class="addon"><?php echo \dash\data::storeCurrency(); ?></label>
							</div>
						</div>
					</div>


					<?php if(false) {?>

					<div class="switch1 mT10">
						<input type="checkbox" name="sendbycourier" id="sendbycourier" <?php if(\dash\data::shippingSettingSaved_sendbycourier()) { echo 'checked'; } ?>>
						<label for="sendbycourier"></label>
						<label for="sendbycourier"><?php echo T_("Send by courier?"); ?></label>
					</div>

					<div data-response='sendbycourier' <?php if(!\dash\data::shippingSettingSaved_sendbycourier()) {echo 'data-response-hide'; }  ?> >
						<div class="input">
							<input type="text" name="sendbycourierprice" id="iShippingCurrentCountryValue" placeholder="<?php echo T_("Shipping cost") ?>" value="<?php echo \dash\data::shippingSettingSaved_sendbycourierprice(); ?>" data-format="price" maxlength="12">
							<label for="iShippingCurrentCountryValue" class="addon"><?php echo \dash\data::storeCurrency(); ?></label>
						</div>
					</div>
					<div class="switch1 mT10">
						<input type="checkbox" name="sendoutcity" id="sendoutcity" <?php if(\dash\data::shippingSettingSaved_sendoutcity()) { echo 'checked'; } ?>>
						<label for="sendoutcity"></label>
						<label for="sendoutcity"><?php echo T_("Send out of city?"); ?></label>
					</div>
					<div data-response='sendoutcity' <?php if(!\dash\data::shippingSettingSaved_sendoutcity()) {echo 'data-response-hide'; }  ?> >
						<div class="input">
							<input type="text" name="sendoutcityprice" id="sendoutcityprice" placeholder="<?php echo T_("Shipping cost") ?>" value="<?php echo \dash\data::shippingSettingSaved_sendoutcityprice(); ?>" data-format="price" maxlength="12">
							<label for="sendoutcityprice" class="addon"><?php echo \dash\data::storeCurrency(); ?></label>
						</div>
					</div>

					<div class="switch1 mT10">
						<input type="checkbox" name="sendoutprovince" id="sendoutprovince" <?php if(\dash\data::shippingSettingSaved_sendoutprovince()) { echo 'checked'; } ?>>
						<label for="sendoutprovince"></label>
						<label for="sendoutprovince"><?php echo T_("Send out of province?"); ?></label>
					</div>
					<div data-response='sendoutprovince' <?php if(!\dash\data::shippingSettingSaved_sendoutprovince()) {echo 'data-response-hide'; }  ?> >
						<div class="input">
							<input type="text" name="sendoutprovinceprice" id="sendoutprovinceprice" placeholder="<?php echo T_("Shipping cost") ?>" value="<?php echo \dash\data::shippingSettingSaved_sendoutprovinceprice(); ?>" data-format="price" maxlength="12">
							<label for="sendoutprovinceprice" class="addon"><?php echo \dash\data::storeCurrency(); ?></label>
						</div>
					</div>
					<div class="switch1 mT10">
						<input type="checkbox" name="sendoutcountry" id="sendoutcountry" <?php if(\dash\data::shippingSettingSaved_sendoutcountry()) { echo 'checked'; } ?>>
						<label for="sendoutcountry"></label>
						<label for="sendoutcountry"><?php echo T_("Send out of country?"); ?></label>
					</div>
					<div data-response='sendoutcountry' <?php if(!\dash\data::shippingSettingSaved_sendoutcountry()) {echo 'data-response-hide'; }  ?> >
						<div class="input">
							<input type="text" name="sendoutcountryprice" id="sendoutcountryprice" placeholder="<?php echo T_("Shipping cost") ?>" value="<?php echo \dash\data::shippingSettingSaved_sendoutcountryprice(); ?>" data-format="price" maxlength="12">
							<label for="sendoutcountryprice" class="addon"><?php echo \dash\data::storeCurrency(); ?></label>
						</div>
					</div>
				<?php } //endif ?>

				</div>

			</div>

			<footer class="txtRa">
				<button class="btn primary"><?php echo T_("Save"); ?></button>
			</footer>
		</div>
	</div>

</form>