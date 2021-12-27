<?php
namespace content_love\log\show;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Log"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$log_id = \dash\request::get('id');

		if(!$log_id || !is_numeric($log_id))
		{
			\dash\header::status(404);
		}

		$dataRow = \dash\db\logs::get_by_id($log_id);
		\dash\data::dataRow($dataRow);

	}
}
?>