<?php
namespace content_crm\log\caller;


class view
{
	public static function config()
	{

		if(!\dash\permission::supervisor())
		{
			\dash\header::status(404);
		}

		\dash\face::title(T_("Log"));


		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$dataTable = \dash\db\logs::get_caller_group();
		\dash\data::dataTable($dataTable);
	}
}
?>