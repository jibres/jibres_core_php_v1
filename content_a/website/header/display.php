<?php $header_detail = \dash\data::activeHeaderDetail(); ?>


<section class="f" data-option='website-change-header'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Your Current Header Template");?> <b class="fc-green"><?php echo \dash\data::activeHeaderDetail_title(); ?></b></h3>
      <div class="body">
        <p><?php echo T_("You can change design of your header completely. We allow you full personalization. Design and build your own high-quality websites."); ?> </p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that();?>/template"><?php echo T_("Change header") ?></a>
    </div>
  </div>
</section>


<?php
foreach (\dash\data::activeHeaderDetail_contain() as $box => $box_detail)
{
	if(is_string($box))
	{
		if(is_array($box_detail))
		{
			$addr = root. 'content_a/website/header/box/'. $box. '.php';
			if(is_file($addr))
			{
				require_once($addr);
			}
		}
	}
}
?>


<section class="f" data-option='website-change-top-line'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Special Announcement");?></h3>
      <div class="body">
        <p><?php echo T_("You can show something on top of everything on your website. Special offer, some news or something else you want. This is a simple way to show something to everyone.") ?> </p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that();?>/announcement"><?php echo T_("Set Special Announcement") ?></a>
    </div>
  </div>
</section>

<section class="f" data-option='website-header-upload-logo'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo \lib\store::detail('title');?></h3>

      <div class="body">
        <p><?php echo \lib\store::detail('desc');?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a href="<?php echo \dash\url::here(). '/setting/general' ?>" class="btn primary txtC"><?php echo T_("Business Branding") ?></a>
    </div>
  </form>
</section>
