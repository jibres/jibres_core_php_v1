
<div class="f">


	<div class="c s12">
		<a class="dcard x1" href='<?php echo \dash\url::this(); ?>/create'>
			<div class="statistic red">
				<div class="value"><i class="sf-plus"></i></div>
				<div class="label"><?php echo T_("Create new gift"); ?></div>
			</div>
		</a>
	</div>

	<div class="c s12">
		<a class="dcard x1" href='<?php echo \dash\url::this(); ?>/all'>
			<div class="statistic red">
				<div class="value"><i class="sf-list"></i></div>
				<div class="label"><?php echo T_("List"); ?></div>
			</div>
		</a>
	</div>


</div>

<?php
$gCode         = \dash\data::dataRow_code();
$gPercent      = \dash\data::dataRow_giftpercent();
$gExpireDate   = \dash\data::dataRow_dateexpire();
$gMaxGift      = \dash\data::dataRow_giftmax();
$gDesc         = \dash\data::dataRow_desc();
$gUsageperuser = \dash\data::dataRow_usageperuser();
?>

<?php require root."/content_love/gift/home/giftcard.php"; ?>

