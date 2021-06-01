<?php $datRow = a(\lib\store::detail(), 'store_data'); ?>
<form method="post" autocomplete="off">
	<div class="avand-md">
		<div class="box">
			<div class="pad">
				<p><?php echo T_("If you want to issue an official invoice, complete your legal information."); ?> <?php echo T_("It's totaly optional!"); ?></p>
				<div class="row mB20">
					<div class="c-xs-12 c-sm-6">
						<div class="radio3">
							<input type="radio" name="seller_type" value="real" id="accounttypereal" <?php if(a($datRow, 'seller_type') === 'real') { echo 'checked'; } ?>>
							<label for="accounttypereal"><?php echo T_("Real account") ?></label>
						</div>
					</div>
					<div class="c-xs-12 c-sm-6">
						<div class="radio3">
							<input type="radio" name="seller_type" value="legal" id="accounttypelegal" <?php if(a($datRow, 'seller_type') === 'legal') { echo 'checked'; } ?>>
							<label for="accounttypelegal"><?php echo T_("Legal account") ?></label>
						</div>
					</div>
				</div>
				<label for="icompanyeconomiccode"><?php echo T_("Economic code"); ?></label>
				<div class="input">
					<input type="text" name="companyeconomiccode" id="icompanyeconomiccode" value="<?php echo a($datRow, 'companyeconomiccode'); ?>" data-format='int' maxlength="12">
				</div>
				<label for="inationalcode"><?php echo T_("Nationalcode"); ?> <small data-response='seller_type' data-response-where='legal' <?php if(a($datRow, 'seller_type') !== 'legal') { echo 'data-response-hide'; } ?>><?php echo T_("CEO"); ?></small></label>
				<div class="input">
					<input type="text" name="nationalcode" id="inationalcode" value="<?php echo a($datRow, 'nationalcode'); ?>" data-format='nationalCode'>
				</div>
				<label for="iwebsite"><?php echo T_("Website"); ?></label>
				<div class="input">
					<input type="url" name="website" id="iwebsite" placeholder="<?php echo \lib\store::url(); ?>" value="<?php echo a($datRow, 'website'); ?>" maxlength='63'>
				</div>
				<div data-response='seller_type' data-response-where='legal' <?php if(a($datRow, 'seller_type') !== 'legal') { echo 'data-response-hide'; } ?>>
					<label for="icompanyname"><?php echo T_("Company name"); ?></label>
					<div class="input">
						<input type="text" name="companyname" id="icompanyname" value="<?php echo a($datRow, 'companyname'); ?>" maxlength="40">
					</div>
					<label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
					<div class="input">
						<input type="text" name="companyregisternumber" id="icompanyregisternumber" value="<?php echo a($datRow, 'companyregisternumber'); ?>" data-format='int' maxlength="10">
					</div>
					<label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
					<div class="input">
						<input type="text" name="companynationalid" id="icompanynationalid" value="<?php echo a($datRow, 'companynationalid'); ?>" data-format='int' maxlength="11">
					</div>
					<?php if(false) {?>
					<label for="vatNumber"><?php echo T_("VAT number"); ?></label>
					<div class="input">
						<input type="text" name="companyregisternumber" id="vatNumber" value="<?php echo a($datRow, 'companyregisternumber'); ?>" data-format='int'>
					</div>
				<?php } //endif ?>
				</div>
			</div>
			<footer class="txtRa">
				<button class="btn master"><?php echo T_("Save") ?></button>
			</footer>
		</div>
	</div>
</form>