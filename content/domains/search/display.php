<div class="jibresBanner">
 <div class="avand impact">

  <form class="domainSearchBox" action='<?php echo \dash\url::kingdom() ?>/domains/search' method='get' autocomplete='off'>
   <h4 class="txtC"><?php echo T_('Discover the perfect domain now'); ?></h4>
  <div class="input ltr">
   <input type="search" name="q" id='domainFirstSearch' maxlength='63' value="<?php echo \dash\data::myDomain(); ?>" autocomplete='off' <?php if (!\dash\detect\device::detectPWA() && 0) echo 'autofocus'?>>
   <button class="addon btn primary"><?php echo T_('Search'); ?></button>
  </div>
 </form>

<?php include (root. 'content_my/domain/buy/display-search.php'); ?>


 </div>
 <div class="avand impact">

 	<h2><?php echo T_('Buy a domain name and create your website today.'); ?></h2>
 	<p><?php echo T_('Welcome to the domain registrar that has everything you need to get the right domain name for your personal or business website.')?></p>
 	<p><?php echo T_("You can choose from the most in-demand and recognizable domain names at great prices, with new choices added regularly. So you can register a domain that helps your online presence either take off, or hit new heights. That's where Jibres comes in.")?></p>

 	<h3><?php echo T_('Register Your Dream Domain Today.'); ?></h3>
 	<p><?php echo T_("Remember to come up with words that are easy to spell and reflect the purpose of your website. Ask friends and family for their opinions - the more the merrier in your search for the perfect website domain name. Once you've come up with an exciting idea, it's time to see if your domain name has been taken.") ?></p>


 	<p class="fc-mute hide"><?php echo T_('*ICANN (the Internet Corporation for Assigned Names and Numbers) charges a mandatory annual fee of $0.18 for each domain registration, renewal or transfer. This will be added to the listed price for some domains, at the time of purchase.'); ?></p>

 </div>


<?php include "faq.php"; ?>

</div>