<?php
namespace content_a\setting\samandehi;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('samandehi'));
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/website');

	}
}
?>