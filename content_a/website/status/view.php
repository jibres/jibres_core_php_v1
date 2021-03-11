<?php
namespace content_a\website\status;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Website Headers'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/advance');

		$website_status = \lib\app\website\status\get::status();

		\dash\data::websiteStatus($website_status);
	}
}
?>
