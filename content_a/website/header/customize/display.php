<?php $header_detail = \dash\data::activeHeaderDetail(); ?>


<section class="f" data-option='website-change-header'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Change header");?></h3>
      <div class="body">
        <p><?php echo T_("Your current header choosed") ?> <b><?php echo \dash\data::activeHeaderDetail_title(); ?></b></p>
        <p><?php echo T_("Your can change template of header.");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::this();?>/header"><?php echo T_("Change header") ?></a>
    </div>
  </div>
</section>


<?php
foreach (\dash\data::activeHeaderDetail_contain() as $box => $box_detail)
{
	if(is_string($box))
	{
		if($box_detail)
		{
			$addr = root. 'content_a/website/header/customize/box/'. $box. '.php';
			if(is_file($addr))
			{
				require_once($addr);
			}
		}
	}
}
?>