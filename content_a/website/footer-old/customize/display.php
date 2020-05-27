<?php $footer_detail = \dash\data::activeFooterDetail(); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">
	<div class="msg fs14 primary2 txtB">
	  	<div class="f">
	  		<div class="c">
				<?php echo T_("Customize your footer"); ?>
	  		</div>
	  		<div class="cauto os">
	          <a class="btn primary" href="<?php echo \dash\url::this();?>/footer"><?php echo T_("Change footer") ?></a>
	  		</div>
		</div>
  	</div>

<?php
foreach (\dash\data::activeFooterDetail_step() as $box => $box_detail)
{
	if(is_string($box))
	{
		if($box_detail)
		{
			$addr = root. 'content_a/website/footer/customize/box_'. $box. '.php';
			if(is_file($addr))
			{
				require_once($addr);
			}
		}
	}
}
?>
  </div>
</div>
