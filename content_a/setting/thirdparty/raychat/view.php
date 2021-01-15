<?php
namespace content_a\setting\addon\raychat;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Raychat live chat'));


		// back

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/website');
	}
}
?>