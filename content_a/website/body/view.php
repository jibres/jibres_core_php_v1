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

				// back
		\dash\data::action_text(T_('Add line'));
		\dash\data::action_link(\dash\url::that(). '/add');


		$body_line_list = \lib\app\website\body\get::line_list();
		\dash\data::bodyLineList($body_line_list);


	}
}
?>
