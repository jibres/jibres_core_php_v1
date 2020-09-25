<?php
namespace content_a\setting\domain\subdomain;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Add new domain'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


	}
}
?>