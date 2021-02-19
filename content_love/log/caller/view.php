<?php
namespace content_love\log\caller;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Log"));


		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$date = \dash\validate::datetime(\dash\request::get('start'), false);

		$dataTable = \dash\db\logs::get_caller_group($date);
		\dash\data::dataTable($dataTable);
	}
}
?>