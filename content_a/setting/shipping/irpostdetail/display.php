<form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">
	<div class="avand-md">
		<div class="box">

			<div class="body">
				<label for="weight"><?php echo T_("Weight") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
				<div class="input">
					<input type="tel" id="weight" name="w" value="<?php echo \dash\request::get('w') ?>" data-format='weight' maxlength="7" required>
				</div>

				<label><?php echo T_("Choose order type") ?></label>
				<div class="row mB20">
					<div class="c-xs-6 c-sm-6">
						<div class="radio3">
							<input type="radio" name="t" value="sefareshi" id="sefareshi" <?php if(\dash\request::get('t') === 'sefareshi') {echo 'checked';} ?>>
							<label for="sefareshi"><?php echo T_("Sefareshi") ?></label>
						</div>
					</div>
					<div class="c-xs-6 c-sm-6">
						<div class="radio3">
							<input type="radio" name="t" value="pishtaz" id="pishtaz" <?php if(\dash\request::get('t') === 'pishtaz') {echo 'checked';} ?>>
							<label for="pishtaz"><?php echo T_("Pishtaz") ?></label>
						</div>
					</div>
				</div>

				<label><?php echo T_("Package type") ?></label>
				<div class="row mB20">
					<div class="c-xs-6 c-sm-6">
						<div class="radio3">
							<input type="radio" name="p" value="pocket" id="pocket" <?php if(\dash\request::get('p') === 'pocket') {echo 'checked';} ?>>
							<label for="pocket"><?php echo T_("Pocket") ?></label>
						</div>
					</div>
					<div class="c-xs-6 c-sm-6">
						<div class="radio3">
							<input type="radio" name="p" value="box" id="box" <?php if(\dash\request::get('p') === 'box') {echo 'checked';} ?>>
							<label for="box"><?php echo T_("Box") ?></label>
						</div>
					</div>
				</div>


				<div class="row mB20">
					<div class="c-xs-6 c-sm-6">
						<label><?php echo T_("Sender location") ?></label>
						<?php \dash\utility\location::provinceSelectorHtml('IR', \dash\request::get('p1'),  \dash\request::get('c1'), 'p1', 'p1', 'c1', 'c1'); ?>
					</div>
					<div class="c-xs-6 c-sm-6">
						<?php \dash\utility\location::citySelectorHtml(\dash\request::get('c1'),  'c1','c1'); ?>
					</div>
				</div>


				<label><?php echo T_("Send to") ?></label>
				<div class="row mB20">
					<div class="c-xs-6 c-sm-6">
						<div class="radio3">
							<input type="radio" name="st" value="i" id="inprovice" <?php if(\dash\request::get('st') === 'i') {echo 'checked';} ?>>
							<label for="inprovice"><?php echo T_("In province") ?></label>
						</div>
					</div>
					<div class="c-xs-6 c-sm-6">
						<div class="radio3">
							<input type="radio" name="st" value="o" id="otherprovince" <?php if(\dash\request::get('st') === 'o') {echo 'checked';} ?>>
							<label for="otherprovince"><?php echo T_("Other province") ?></label>
						</div>
					</div>
				</div>


				<div data-response='st' data-response-where='o' <?php if(\dash\request::get('st') === 'o') {}else{echo 'data-response-hide';} ?>  class="mB20">
					<div class="row">
						<div class="c-xs-6 c-sm-6">
							<label><?php echo T_("Send to") ?></label>
							<?php \dash\utility\location::provinceSelectorHtml('IR', \dash\request::get('p2'),  \dash\request::get('c2'), 'p2', 'p2', 'c2', 'c2'); ?>
						</div>
						<div class="c-xs-6 c-sm-6">
							<?php \dash\utility\location::citySelectorHtml(\dash\request::get('c2'), 'c2','c2'); ?>
						</div>
					</div>

				</div>







			</div>
			<footer class="f">
				<div class="cauto"><a class="btn link" href="<?php echo \dash\url::current() ?>"><?php echo T_("Clear") ?></a></div>
				<div class="c"></div>
				<div class="cauto"><button class="btn master"><?php echo T_("Calcuate") ?></button></div>

			</footer>

		</div>
		<?php $result = \dash\data::irpostResult(); if($result && is_numeric($result)) {  ?>
			<div class="box">
				<div class="body">
					<div class=" font-14 txtB txtC ">
						<div><?php echo T_("Shipping value") ?></div>
						<div class="fc-blue font-16"><?php echo \dash\fit::number($result). ' '. T_("Rial"); ?></div>
					</div>
				</div>
			</div>
		<?php } //endif ?>
	</div>

</form>