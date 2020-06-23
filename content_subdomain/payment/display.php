
	<div class="avand">
		<div class="box">
			<header><h2><?php echo T_("Choose payment") ?></h2></header>
			<div class="body">
				<form method="post" autocomplete="off">
					<?php if(\dash\data::paymentWay()) {?>

						<?php foreach (\dash\data::paymentWay() as $key => $value) {?>

							<div class="radio3 mB10">
								<input  id="payway<?php echo $key; ?>" type="radio" name="payway" value="<?php echo \dash\get::index($value, 'key'); ?>" <?php if($key === 'online') { echo 'checked';} ?>>
								<label for="payway<?php echo $key; ?>"><?php echo \dash\get::index($value, 'title'); ?></label>
							</div>

						<?php } //endfor ?>

					<?php } // endif ?>
					<button class="btn master" type="submit" name="button" value="saveorder"><?php echo T_("Pay"); ?></button>
				</form>

			</div>



		</div>


		<?php if(\dash\data::dataTable()) {?>

			<div class="row mT10">

				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<div class="c-xs-12 c-sm-6 c-lg-4 c-xxl-3">
						<a class="jProduct1" href="<?php echo \dash\get::index($value, 'url'); ?>">
							<img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
							<footer>
								<div class="title"><?php echo \dash\get::index($value, 'title') ?></div>
								<div class="price"><span><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span> <span class="unit"><?php echo \dash\get::index($value, 'unit'); ?></span></div>
								<div class="title"><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></div>

							</footer>
						</a>
					</div>
				<?php } //endfor ?>
			</div>
		<?php }else{ // no product in cart ?>
			<div class="msg warn2 txtC txtB fs14"><?php echo T_("No product in your cart") ?></div>
		<?php } //endif ?>
	</div>