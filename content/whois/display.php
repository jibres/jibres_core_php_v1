<div class="jibresBanner">
 <div class="fit">
<div class="f justify-center">
	<div class="c6 s12">
		<form method="post" autocomplete="off">
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
<?php
if(\dash\data::whoisResult())
{
?>


<div class="f justify-center mT20">

	<div class="c12 s12 mT10">

		<?php if(\dash\data::whoisResult_available()) {?>
			<div class="f msg success">
				<div class="c"><?php echo T_("Domain is available"); ?></div>
				<div class="cauto"><a class="btn success2" href="<?php echo \dash\url::kingdom() ?>/domains/search?q=<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Register domain"); ?></a></div>
			</div>


		<?php } //endif ?>


<?php if(\dash\data::whoisResult_answer()) {?><samp><?php echo \dash\data::whoisResult_answer(); ?></samp><?php } //endif ?>
	</div>
</div>

<?php
} // endif
?>

 </div>
</div>