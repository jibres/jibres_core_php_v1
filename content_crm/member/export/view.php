<?php
namespace content_crm\member\export;


class view
{
	public static function config()
	{

		// page title
		\dash\face::title(T_("Export Members"));
		// back
		\dash\data::back_text(T_('Members'));
		\dash\data::back_link(\dash\url::this());

		$count_all = \dash\app\user\export::count_all();
		\dash\data::countAll($count_all);

		if(\dash\request::get('download') === 'now')
		{
			\dash\app\user\export::download_now();
		}

		if(\dash\request::get('id'))
		{
			\lib\app\export\download::export_members(\dash\request::get('id'));
		}

		$list = \dash\app\user\export::list();
		\dash\data::exportList($list);
	}
}
?>
