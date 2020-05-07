<?php
if(\dash\user::id())
{
	if(\dash\permission::check('websiteManager'))
	{
		echo '<div class="line info"><a target="_blank" href="'.\dash\url::sitelang(). '/'.\lib\store::code().'/a/website">'. T_("Customize website").'</a></div>';
	}
}
?>
