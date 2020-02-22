



<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">


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


		<?php } //endif ?>


		<?php if(\dash\data::checkResult()) {?>

			<?php if(\dash\data::checkResult_available()) {?>

				<form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">

				<?php if(\dash\request::get('period')) {?>

					<input type="hidden" name="period" value="<?php echo \dash\request::get('period'); ?>">

				<?php }//endif ?>

				<label for="irnicid"><?php echo T_("IRNIC contact admin"); ?> <small><a target="_blank" href="<?php echo \dash\url::this(); ?>/contact/add?type=new"><?php echo T_("Create new IRNIC contact"); ?></a></small></label>
				<select name="irnicid" class="select ui dropdown search addition" id="irnicid">
				<option value=""><?php echo T_("IRNIC contact id"); ?></option>

				<?php foreach (\dash\data::myContactList() as $key => $value) {?>

				  <option value="<?php echo @$value['nic_id']; ?>" <?php if(isset($value['isdefault']) && $value['isdefault']) { echo "selected"; } ?>><?php echo @$value['nic_id']; ?></option>

				<?php } //endfor ?>

				</select>




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

