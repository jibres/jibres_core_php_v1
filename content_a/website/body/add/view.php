<?php
namespace content_a\website\body\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new block'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

		$body_line = \lib\app\website\body\template::list();
		\dash\data::bodyLine($body_line);


		$body_line_list = \lib\app\website\body\get::line_list();
		if(!$body_line_list)
		{
			\dash\data::back_link(\dash\url::this());
		}

	}
}
?>
