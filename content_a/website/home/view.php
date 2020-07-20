<?php
namespace content_a\website\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Build Your Unique Online Website'));

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		$isset_header = \lib\app\website\header\get::isset_header();

		\dash\data::issetHeader($isset_header);

		$isset_footer = \lib\app\website\footer\get::isset_footer();

		\dash\data::issetFooter($isset_footer);

		$website_status = \lib\app\website\status\get::status();

		\dash\data::websiteStatus($website_status);


		if($website_status === false)
		{
			\lib\app\website\init::status();

			$body_line_list = \lib\app\website\body\get::line_list();

			if(!$body_line_list)
			{
				\lib\app\website\init::body();
			}
		}

		if($isset_header === false)
		{
			\lib\app\website\init::header();
		}

		if($isset_footer === false)
		{
			\lib\app\website\init::footer();
		}

	}
}
?>
