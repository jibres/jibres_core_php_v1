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

	<div class="c8 s12 mT10">

		<?php
		if(\dash\data::whoisResult_available())
		{
			echo '<div class="msg success">'. T_("Domain is available"). '</div>';
		}
		?>

		<pre>
			<?php echo \dash\data::whoisResult_answer(); ?>
		</pre>
	</div>
</div>

<?php
} // endif
?>

 </div>
</div>