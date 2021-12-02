<?php
namespace content_love\apilog\twitter\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Log"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$log_id = \dash\request::get('id');

		if(!$log_id || !is_numeric($log_id))
		{
			\dash\header::status(404);
		}

		$dataRow = \lib\app\twitter\get::get($log_id);
		\dash\data::dataRow($dataRow);

	}
}
?>