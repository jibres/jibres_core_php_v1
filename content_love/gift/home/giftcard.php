<?php
// variables
if(!isset($gCode))
{
	$gCode = "Javad-Promo-1";
}
if(!isset($gPercent))
{
	$gPercent = "0";
}
if(!isset($gExpireDate))
{
	$gExpireDate = "2020-02-12";
}
if(!isset($gMaxGift))
{
	$gMaxGift = "10000";
}
?>
<div class="giftBox">
	<div class="giftcard">
		<header class="f align-center">
			<div class="cauto pRa20">
				<img class="logo" src="<?php echo \dash\url::icon();?>" alt="<?php echo T_("Jibres");?>">
			</div>
			<div class="c">
				<h2 class="txtB mB0"><?php echo T_("Jibres"); ?></h2>
				<h3><?php echo T_("Sell & Enjoy"); ?></h3>
			</div>
			<div class="cauto os pLa20">
				<div class="f">
					<abbr class="c6"><?php echo T_("Expire Date");?></abbr>
					<span class="c6"><?php echo \dash\fit::date($gExpireDate); ?></span>
				</div>
				<div class="f">
					<abbr class="c6"><?php echo T_("Max Gift");?></abbr>
					<span class="c6"><?php echo \dash\fit::number($gMaxGift). ' '. T_("Toman");?></span>
				</div>
			</div>
		</header>
		<div class="body">
			<img src="<?php echo \dash\url::cdn();?>/img/bg/enter/default.jpg" alt="<?php echo T_("Jibres Gift Card");?>">
			<div class="code">
				<abbr><?php echo T_("Jibres Gift Code"); ?></abbr>
				<span class="block"><?php echo $gCode; ?></span>
			</div>
			<code class="circle"><span class="percent"><?php echo $gPercent; ?></span><span>%</span></code>
		</div>
	</div>
</div>

