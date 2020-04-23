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
 ?>
<div class="giftBox">
	<div class="giftcard">
		<header class="f align-center">
			<div class="cauto pRa20">
				<img class="logo" src="<?php echo \dash\url::icon();?>" alt="<?php echo T_("Jibres");?>">
			</div>
			<div class="c pRa20">
				<h2 class="txtB mB0"><?php echo T_("Jibres"); ?></h2>
				<h3><?php echo T_("Sell & Enjoy"); ?></h3>
			</div>
			<div class="c5">

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

