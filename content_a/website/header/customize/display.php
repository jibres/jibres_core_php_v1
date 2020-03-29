<?php $header_detail = \dash\data::activeHeaderDetail(); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">
	<div class="msg fs14 primary2 txtB">
	  	<div class="f">
	  		<div class="c">
				<?php echo T_("Customize your header"); ?>
	  		</div>
	  		<div class="cauto os">
	          <a class="btn primary" href="<?php echo \dash\url::this();?>/header"><?php echo T_("Change header") ?></a>
	  		</div>
		</div>
  	</div>

<?php
foreach (\dash\data::activeHeaderDetail_step() as $box => $box_detail)
{
	if(is_string($box))
	{
		if($box_detail)
		{
			$addr = root. 'content_a/website/header/customize/box_'. $box. '.php';
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
