

<div class="f justify-center">
  <div class="c6 m8 s12">
	<div class="msg fs14 primary2 txtB">
	  <?php echo T_("Customize your header"); ?>
	</div>
<?php
foreach (\dash\data::activeHeaderDetail_step() as $box)
{
	if(is_string($box))
	{
		$addr = root. 'content_a/website/header/customize/box_'. $box. '.php';
		if(is_file($addr))
		{
			require_once($addr);
		}
	}
}
?>
  </div>
</div>
