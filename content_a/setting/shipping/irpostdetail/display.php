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
							<input type="radio" name="sendtype" value="inprovince" id="inprovice" <?php if(\dash\request::get('sendtype') === 'inprovice') {echo 'checked';} ?>>
							<label for="inprovice"><?php echo T_("In province") ?></label>
						</div>
					</div>
					<div class="c-xs-6 c-sm-6">
						<div class="radio3">
							<input type="radio" name="sendtype" value="otherprovince" id="otherprovince" <?php if(\dash\request::get('sendtype') === 'otherprovince') {echo 'checked';} ?>>
							<label for="otherprovince"><?php echo T_("Other province") ?></label>
						</div>
					</div>
				</div>


				<div data-response='sendtype' data-response-where='otherprovince' <?php if(\dash\request::get('sendtype') === 'otherprovince') {}else{echo 'data-response-hide';} ?>  class="mB20">
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
				<div class="cauto"><button class="btn master"><?php echo T_("Calculate") ?></button></div>

			</footer>

		</div>
		<?php $result = \dash\data::irpostResult(); if($result && is_array($result)) { $currency = \dash\get::index($result, 'currency'); ?>

			<nav class="items">
			  <ul>
			   	<?php if(\dash\get::index($result, 'basic')) {?>
			    <li>
			    	<a class="f">
				    	<div class="key">
				    		<?php echo T_("Basic price"); ?>
				    	</div>
			    		<div class="value">
			    			<?php echo \dash\fit::number(\dash\get::index($result, 'basic')) ?> <small><?php echo $currency ?></small>
			    		</div>
			    	</a>
			   	</li>
			   <?php } //endif ?>

			   	<?php if(\dash\get::index($result, 'province_center')) {?>

			   	<li>
			    	<a class="f">
				    	<div class="key">
				    		<?php echo T_("Send from province center"). ' '. T_("10%"); ?>
				    	</div>
			    		<div class="value">
			    			<?php echo \dash\fit::number(\dash\get::index($result, 'province_center')) ?> <small><?php echo $currency ?></small>
			    		</div>
			    	</a>
			   	</li>
				<?php } //endif ?>
				<?php if(\dash\get::index($result, 'insurance')) {?>
			   	<li>
			    	<a class="f">
				    	<div class="key">
				    		<?php echo T_("Insurance"); ?>
				    	</div>
			    		<div class="value">
			    			<?php echo \dash\fit::number(\dash\get::index($result, 'insurance')) ?> <small><?php echo $currency ?></small>
			    		</div>
			    	</a>
			   	</li>
				<?php } //endif ?>


				<?php if(\dash\get::index($result, 'vat')) {?>

			   	<li>
			    	<a class="f">
				    	<div class="key">
				    		<?php echo T_("Vat"). ' '. T_("9%"); ?>
				    	</div>
			    		<div class="value">
			    			<?php echo \dash\fit::number(\dash\get::index($result, 'vat')) ?> <small><?php echo $currency ?></small>
			    		</div>
			    	</a>
			   	</li>
				<?php } //endif ?>


				<?php if(\dash\get::index($result, 'price')) {?>
			   	<li>
			    	<a class="f">
				    	<div class="key">
				    		<?php echo T_("Total"); ?>
				    	</div>
			    		<div class="value txtB">
			    			<?php echo \dash\fit::number(\dash\get::index($result, 'price')) ?> <small><?php echo $currency ?></small>
			    		</div>
			    	</a>
			   	</li>
			   <?php } //endif ?>


			  </ul>
			</nav>

			<?php if(isset($result['error'])) { foreach ($result['error'] as $key => $value) {?>
				<div class="msg danger2 txtB font-14"><?php echo $value ?></div>
			<?php } } ?>
		<?php } //endif ?>
	</div>

</form>