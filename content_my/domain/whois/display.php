<div class="fs14">

	<div class="f justify-center">
		<div class="c6 s12">
			<form method="post" autocomplete="off" action="<?php echo \dash\url::that(); ?>"  >
				<div class="input ltr">
					<input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\data::myDomain(); ?>">
					<button class="btn addon success"><?php echo T_("Check domain"); ?></button>
				</div>
			</form>
			<?php
			if(\dash\data::domainError())
			{
				echo '<div class="msg danger mT20">'. \dash\data::domainError().'</div>';
			}
			?>
		</div>
	</div>
</div>
<?php require_once(root. 'content/whois/whoisDisplay.php'); ?>