
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">
			<p><?php echo T_("Enter you domain to check and renew"); ?></p>
			<form method="post" autocomplete="off" class="mB20" action="<?php echo \dash\url::this(); ?>/renew">
				<input type="hidden" name="whois" value="1">
				<div class="input ltr">
					<input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\data::myDomain(); ?>">
					<button class="btn addon success"><?php echo T_("Check domain"); ?></button>
				</div>
			</form>



			<form method="post" autocomplete="off" action="<?php echo \dash\url::that(); ?>">

			<?php if(\dash\data::myDomain()) {?>

				<input type="hidden" name="domain" value="<?php echo \dash\data::myDomain(); ?>">

			<?php }//endif ?>

			<label for="irnicid"><?php echo T_("IRNIC Handle admin"); ?> <small><a target="_blank" href="<?php echo \dash\url::this(); ?>/contact/add?type=new"><?php echo T_("Create new IRNIC Handle"); ?></a></small></label>
			<select name="irnicid" class="select ui dropdown search addition" id="irnicid">
			<option value=""><?php echo T_("IRNIC Handle id"); ?></option>

			<?php foreach (\dash\data::myContactList() as $key => $value) {?>

			  <option value="<?php echo \dash\get::index($value, 'nic_id'); ?>" <?php if(isset($value['isdefault']) && $value['isdefault']) { echo "selected"; } ?>><?php echo \dash\get::index($value, 'nic_id'); ?></option>

			<?php } //endfor ?>

			</select>


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




			<h4><?php echo T_("Pay type"); ?></h4>
			<div class="f mB10">


		      <div class="c pRa5">
		          <div class="radio3">
		            <input type="radio" name="pay" value="budget" id="paybudget" <?php if(!\dash\user::budget()) { echo 'disabled';} ?>>
		            <label for="paybudget"><?php echo T_("Pay by your budget"); ?> <small><?php echo \dash\fit::number(\dash\user::budget()); ?> <span class="sf-mute"><?php echo T_("Toman"); ?></span></small></label>
		          </div>
		      </div>



		      <div class="c">
		          <div class="radio3">
		            <input type="radio" name="pay" value="gateway" id="paygateway" <?php if(!\dash\user::budget()) { echo 'checked';} ?>>
		            <label for="paygateway"><?php echo T_("Bank payment"); ?> <span> </label>
		          </div>
		      </div>
		    </div>


		    <div class="check1">
		      <input type="checkbox" name="agree" id="agree">
		      <label for="agree"><?php echo T_("I have read and agree to the terms and conditions"); ?> <small><a target="_blank" href="https://www.nic.ir/Domain_Register_Policy.html"><?php echo T_("Show terms"); ?></a></small></label>
		    </div>

		    <div class="f mT20">
		    	<div class="cauto">

					<a href="<?php echo \dash\url::that() ?>" class="btn secondary"><?php echo T_("Cancel"); ?></a>
		    	</div>

		    	<div class="c"></div>

		    	<div class="cauto">
					<button class="btn success"><?php echo T_("Renew domain"); ?></button>

		    	</div>
		    </div>

		</form>



		</div>
	</div>
</div>

