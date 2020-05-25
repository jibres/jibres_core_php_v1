
<div class="box">
	<img class="x200"> src="<?php echo \dash\url::cdn(); ?>\img\flags\svg\<?php echo \dash\data::ip_countryCode(); ?>.svg" alt='<?php echo \dash\data::ip_country(); ?>'>
</div>


<div class="row">
	<div class="c-12">

	</div>
</div>

<div class="dcard x3 txtC" >
 <div class="statistic"><div class="value"><i class="sf-card"></i></div></div>
  <h2><?php echo T_("Your sms panel balance"); ?><br><b><?php echo \dash\fit::number(\dash\data::SMSbalance_remaincredit() / 10); ?></b> <?php echo \lib\currency::unit(); ?></h2>

</div>
