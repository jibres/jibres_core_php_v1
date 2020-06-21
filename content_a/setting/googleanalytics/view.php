<?php
namespace content_a\setting\googleanalytics;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Google Analytics'));


		// back

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/website');
	}
}
?>