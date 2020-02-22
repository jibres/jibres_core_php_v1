<div class="jibresBanner">
 <div class="fit">

  <form class="domainSearchBox" action='<?php echo \dash\url::kingdom() ?>/domains/search' method='get' autocomplete='off'>
   <h4 class="txtC"><?php echo T_('Discover the perfect domain now'); ?></h4>
  <div class="input ltr">
   <input type="text" name="q" id='domainFirstSearch' maxlength='63' value="<?php echo \dash\data::myDomain(); ?>" autocomplete='off' <?php if (!\dash\detect\device::detectPWA() && 0) echo 'autofocus'?>>
   <button class="addon btn primary"><?php echo T_('Search'); ?></button>
  </div>
 </form>

  <div class="result ltr">
 	<?php if(\dash\data::infoResult()) {?>
 		<?php foreach (\dash\data::infoResult() as $key => $value) {?>
 			<?php if(isset($value['soon']) && $value['soon']) {?>
 				<div class="msg minimal mB5">
		 			<div class="f align-center pL10">
		 				<div class="c pR10"><?php echo $key; ?> </div>
		 				<div class="cauto pR20"></div>
		 				<div class="cauto">
		 					<a class="btn"><?php echo T_("Coming Soon"); ?></a>
		 				</div>
		 			</div>
		 		</div>
 			<?php continue; ?>
 			<?php }// endif ?>

 			<?php if(isset($value['available']) && $value['available']) {?>

		 		<div class="msg minimal mB5 success2">
		 			<div class="f align-center pL10">
		 				<div class="c pR10 txtB"><?php echo $key; ?> </div>
		 				<div class="cauto pR20"><span class="compact"><?php echo T_('Toman'). ' '. \dash\fit::number('2000') ?></span> / <del class="compact fc-mute"><?php echo \dash\fit::number('5000'); ?></del></div>
		 				<div class="cauto">
		 					<a class="btn success" href="<?php echo \dash\url::kingdom(); ?>/my/domain/buy/<?php echo $key; ?>"><?php echo T_("Buy"); ?></a>
		 				</div>
		 			</div>
		 		</div>

 			<?php }else{ ?>

 				<div class="msg minimal mB5 danger2">
		 			<div class="f align-center pL10">
		 				<div class="c pR10"><?php echo $key; ?> </div>
		 				<div class="cauto pR20"><?php echo T_("Taken"); ?></div>
		 				<div class="cauto">
		 					<a class="btn" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo $key; ?>"><?php echo T_("Whois taken?"); ?></a>
		 				</div>
		 			</div>
		 		</div>

 			<?php } ?>

 		<?php } //endforeach ?>


 	<?php }elseif(\dash\request::get('q')){ ?>

		<div class="msg warn2">
 			<div class="f">
 				<div class="c">

 					<?php echo T_("Can not register this domain"); ?>
 				</div>
 				<div class="cauto">
 					<a class="btn pain mLR10" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Who is?"); ?></a>
 				</div>
 				<div class="cauto">
 					<a class="btn warn" href="<?php echo \dash\url::kingdom(); ?>/domains/search"><?php echo T_("Try another"); ?></a>
 				</div>
 			</div>
 		</div>

 	<?php } //endif ?>
  </div>

 </div>
 <div class="fit">

 	<h2><?php echo T_('Buy a domain name and create your website today.'); ?></h2>
 	<p><?php echo T_('Welcome to the domain registrar that has everything you need to get the right domain name for your personal or business website.')?></p>
 	<p><?php echo T_("You can choose from the most in-demand and recognizable domain names at great prices, with new choices added regularly. So you can register a domain that helps your online presence either take off, or hit new heights. That's where Jibres comes in.")?></p>

 	<h3><?php echo T_('Register Your Dream Domain Today.'); ?></h3>
 	<p><?php echo T_("Remember to come up with words that are easy to spell and reflect the purpose of your website. Ask friends and family for their opinions - the more the merrier in your search for the perfect website domain name. Once you've come up with an exciting idea, it's time to see if your domain name has been taken.") ?></p>


 	<p class="fc-mute hide"><?php echo T_('*ICANN (the Internet Corporation for Assigned Names and Numbers) charges a mandatory annual fee of $0.18 for each domain registration, renewal or transfer. This will be added to the listed price for some domains, at the time of purchase.'); ?></p>

 </div>


<?php include "faq.php"; ?>

</div>