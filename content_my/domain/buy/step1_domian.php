



<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">
			<p><?php echo T_("Enter you domain to check and register"); ?></p>
			<form method="post" autocomplete="off" class="mB20" action="<?php echo \dash\url::this(); ?>/buy">
				<input type="hidden" name="whois" value="1">
				<div class="input ltr">
					<input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\data::myDomain(); ?>">
					<button class="btn addon success"><?php echo T_("Check domain"); ?></button>
				</div>
			</form>

		<?php if(\dash\data::myDomain()) {?>

			<?php if(\dash\data::checkResult_available()) {?>

			<div class="msg success2 txtC txtB">

				<p><?php echo T_("Domain ready to registered"); ?></p>
				<?php echo \dash\data::myDomain(); ?>

			</div>

			<?php }else{ ?>

			<div class="msg warn2 txtC txtB">
				<p><?php echo T_("Can not register this domain"); ?></p>
				<?php echo \dash\data::myDomain(); ?>

			</div>

			<?php } //endif ?>

		<?php }else{ ?>



			<?php if(\dash\data::domainError()) {?>
			<div class="msg danger"><?php echo \dash\data::domainError(); ?></div>
			<?php } //endif ?>

			<?php if(\dash\data::checkResult()) {?>

				<?php if(\dash\data::checkResult_available()) {?>

				<div class="msg success2"><?php echo T_("Domain is available"); ?>
					<span class="floatL">
						<a class="btn success" href="<?php echo \dash\url::this(); ?>/buy/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Buy"); ?></a>
					</span>
				</div>

				<?php }else{ ?>

				<div class="msg warn2"><?php echo T_("Domain is occupied"); ?>
					<span class="floatL">
						<a class="btn warn" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Whois"); ?></a>
					</span>
				</div>

				<?php } //endif ?>

			<?php } // endif ?>


		<?php } //endif ?>
		</div>
	</div>
</div>

