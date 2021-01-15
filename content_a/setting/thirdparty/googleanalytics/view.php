<?php
namespace content_a\setting\thirdparty\googleanalytics;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Google Analytics'));


		// back

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>