<div class="f justify-center">

		<div class="c8 m11 s12">

			<div class="cbox">
<?php if(\dash\data::dataRow_status() === 'enable') {?>
		<div class="msg success fs14 txtC">
			<?php echo T_("Your domain was registered"); ?>
		</div>

		<p><?php echo T_("You can manage you domain here"); ?>
		<a class="btn pain mLa10" href="<?php echo \dash\url::this(). '/setting/'. \dash\data::dataRow_name(); ?>"><?php echo T_("Manage Domain"); ?></a>
		</p>



<?php }elseif(\dash\data::dataRow_status() === 'failed' || true) {?>
		<div class="msg danger fs14 txtC">
			<?php echo T_("Domain register failed"); ?>
		</div>

		<p><?php echo T_("If you have paid, your money back to your account"); ?>
		<a class="btn success mLa10" href="<?php echo \dash\url::this(). '/buy/'; ?>"><?php echo T_("Register Domain again"); ?></a>
		</p>


<?php } //endif ?>



		</div>

	</div>

</div>
