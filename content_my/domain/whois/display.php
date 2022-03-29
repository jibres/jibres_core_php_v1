<div class="cbox">
	<div class="f justify-center">
		<div class="c6 s12">
			<form method="get" autocomplete="off" action="<?php echo \dash\url::that(); ?>"  >
				<div class="input ltr">
					<input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\data::myDomain(); ?>">
					<button class="btn addon success"><?php echo T_("Check domain"); ?></button>
				</div>
			</form>
			<?php
			if(\dash\data::domainError())
			{
				echo '<div class="alert-danger mt-4">'. \dash\data::domainError().'</div>';
			}
			?>
		</div>
	</div>
	<?php require_once(root. 'content/whois/whoisDisplay.php'); ?>
</div>