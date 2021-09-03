<?php $footer_detail = \dash\data::activeFooterDetail(); ?>


<section class="f" data-option='website-change-footer'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Your Current Footer Template");?> <b class="fc-green"><?php echo \dash\data::activeFooterDetail_title(); ?></b></h3>
      <div class="body">
        <p><?php echo T_("You can change design of your footer completely. We allow you full personalization. Design and build your own high-quality websites."); ?> </p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that();?>/template"><?php echo T_("Change Footer Template") ?></a>
    </div>
  </div>
</section>


<?php
foreach (\dash\data::activeFooterDetail_contain() as $box => $box_detail)
{
	if(is_string($box))
	{
		if(is_array($box_detail))
		{
			$addr = root. 'content_a/website/footer/box/'. $box. '.php';
			if(is_file($addr))
			{
				require_once($addr);
			}
		}
	}
}
?>
