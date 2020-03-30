<?php
namespace content_a\website\body;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Website body content'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$body_line = \lib\app\website_body\line::list();
		\dash\data::bodyLine($body_line);

		$body_line_list = \lib\app\website_body\get::line_list();
		\dash\data::bodyLineList($body_line_list);


	}
}
?>
