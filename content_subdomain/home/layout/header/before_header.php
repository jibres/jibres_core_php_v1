<?php
if(\dash\user::id())
{
	if(\dash\permission::check('websiteManager'))
	{
		echo '<div class="topLine"><a target="_blank" href="'.\dash\url::sitelang(). '/'.\lib\store::code().'/a/website">'. T_("Jibres").'</a></div>';
	}
}
?>
