



<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">

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



		<?php if(\dash\data::checkResult()) {?>

			<?php if(\dash\data::checkResult_available()) {?>

				<form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">



				<h4><?php echo T_("Choose period of pay domain"); ?></h4>
				<div class="f mB10">
			      <div class="c pRa5">
			          <div class="radio3">
			            <input type="radio" name="period" value="1year" id="period1year">
			            <label for="period1year"><?php echo T_("1 Year"); ?> <span> <?php echo \dash\fit::number('3000'). ' '. T_("Toman"); ?> </span></label>
			          </div>
			      </div>
			      <div class="c">
			          <div class="radio3">
			            <input type="radio" name="period" value="5year" id="period5year">
			            <label for="period5year"><?php echo T_("5 Year"); ?> <span> <?php echo \dash\fit::number('15000'). ' '. T_("Toman"); ?> </span></label>
			          </div>
			      </div>
			    </div>





			    <div class="f mT20">
			    	<div class="cauto">

						<a href="<?php echo \dash\url::that() ?>" class="btn secondary"><?php echo T_("Cancel"); ?></a>
			    	</div>

			    	<div class="c"></div>

			    	<div class="cauto">
						<button class="btn success"><?php echo T_("Continue"); ?></button>

			    	</div>
			    </div>

			</form>

			<?php }else{ ?>

			<div class="msg warn2">
				<div class="f">
					<div class="c">
						<?php echo T_("Domain is occupied"); ?>
					</div>
					<div class="cauto">
						<a class="btn warn" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Who is?"); ?></a>
					</div>
				</div>
			</div>

			<?php } //endif ?>


		<?php } //endif ?>
		</div>
	</div>
</div>

