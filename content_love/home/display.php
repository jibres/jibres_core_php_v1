<div class="f">
<?php if(\dash\permission::supervisor()) {?>
	<div class="c12 s12">
		<a class="dcard x2" href='<?php echo \dash\url::sitelang(); ?>/su'>
			<div class="statistic pink">
				<div class="value"><i class="sf-heartbeat"></i></div>
				<div class="label"><?php echo T_("Supervisor Panel"); ?></div>
			</div>
		</a>
	</div>
<?php } ?>

	<div class="c4 s12">
		<a class="dcard x1" href='<?php echo \dash\url::here(); ?>/store'>
			<div class="statistic green">
				<div class="value"><i class="sf-shop"></i></div>
				<div class="label"><?php echo T_("Store list"); ?></div>
			</div>
		</a>
	</div>

	<div class="c4 s12">
		<a class="dcard x1" href='<?php echo \dash\url::here(); ?>/store/analytics'>
			<div class="statistic blue">
				<div class="value"><i class="sf-analytics-chart-graph"></i></div>
				<div class="label"><?php echo T_("Store analytics"); ?></div>
			</div>
		</a>
	</div>


	<div class="c4 s12">
		<a class="dcard x1" href='<?php echo \dash\url::here(); ?>/domain'>
			<div class="statistic blue">
				<div class="value"><i class="sf-list-ul"></i></div>
				<div class="label"><?php echo T_("Domains"); ?></div>
			</div>
		</a>
	</div>

	<div class="c4 s12">
		<a class="dcard x1" href='<?php echo \dash\url::here(); ?>/application'>
			<div class="statistic green">
				<div class="value"><i class="sf-android"></i></div>
				<div class="label"><?php echo T_("Android application queue"); ?></div>
			</div>
		</a>
	</div>

	<div class="c4 s12">
		<a class="dcard x1" href='<?php echo \dash\url::here(); ?>/gift'>
			<div class="statistic red">
				<div class="value"><i class="sf-gift"></i></div>
				<div class="label"><?php echo T_("Gift card"); ?></div>
			</div>
		</a>
	</div>

	<div class="c4 s12">
		<a class="dcard x1" href='<?php echo \dash\url::here(); ?>/transactions'>
			<div class="statistic red">
				<div class="value"><i class="sf-card"></i></div>
				<div class="label"><?php echo T_("Transaction"); ?></div>
			</div>
		</a>
	</div>



	<div class="c4 s12">
		<a class="dcard x1" href='<?php echo \dash\url::here(); ?>/notiflog'>
			<div class="statistic red">
				<div class="value"><i class="sf-camera-surveillance"></i></div>
				<div class="label"><?php echo T_("Notif log"); ?></div>
			</div>
		</a>
	</div>



	<div class="c4 s12">
		<a class="dcard x1" href='<?php echo \dash\url::here(); ?>/business/domain'>
			<div class="statistic blue">
				<div class="value"><i class="sf-globe"></i></div>
				<div class="label"><?php echo T_("Business domains"); ?></div>
			</div>
		</a>
	</div>


</div>

