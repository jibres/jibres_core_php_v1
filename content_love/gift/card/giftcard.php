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
	$gExpireDate = "-";
}
if(!isset($gMaxGift))
{
	$gMaxGift = "-";
}
?>
<div class="giftBox">
	<div class="giftcard">
		<header class="f align-center">
			<div class="cauto pRa20">
				<img class="logo" src="<?php echo \dash\url::icon();?>" alt="<?php echo T_("Jibres");?>">
			</div>
			<div class="c">
				<h2 class="font-bold mB0"><?php echo T_("Jibres"); ?></h2>
				<h3><?php echo T_("Sell & Enjoy"); ?></h3>
			</div>
			<div class="cauto os pLa20 pTB10 meta">
				<div class="f mb-2">
					<abbr class="c"><?php echo T_("Max Gift");?></abbr>
					<span class="c5"><?php echo \dash\fit::number($gMaxGift). ' '. \lib\currency::unit();?></span>
				</div>
				<div class="f">
					<abbr class="c"><?php echo T_("Expire Date");?></abbr>
					<span class="c5"><?php echo $gExpireDate; ?></span>
				</div>
<?php if (isset($gUsageperuser)) { ?>
				<div class="f mt-2">
					<abbr class="c"><?php echo T_("Total Usage for you");?></abbr>
					<span class="c5"><?php echo \dash\fit::number($gUsageperuser). ' '. T_('Times');?></span>
				</div>
<?php } ?>

			</div>
		</header>
		<div class="body">
			<img src="<?php echo \dash\url::cdn();?>/img/bg/gift/star-red.jpg" alt="<?php echo T_("Jibres Gift Card");?>">
			<div class="code">
				<abbr><?php echo T_("Jibres Gift Code"); ?></abbr>
				<span class="block"><?php echo $gCode; ?></span>
			</div>
			<code class="circle"><span class="percent"><?php echo $gPercent; ?></span><span>%</span></code>
		</div>
	</div>
	<div class="text-center fs14 mt-4">
		<p><?php echo T_("You can use gift card on last step of your buy process."); ?></p>
<?php
if(isset($gDesc))
{
	echo "<div class='msg font-bold fs14 mB10'>". $gDesc. "</div>";
}
?>
	</div>
</div>

