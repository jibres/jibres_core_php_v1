<?php
namespace content_a\accounting\factor\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
		$id = \dash\validate::id(\dash\request::get('id'));
		if(!$id)
		{
			\dash\redirect::to(\dash\url::this());
			return;
		}

		$load = \lib\app\tax\doc\template::get($id);

		if(!$load)
		{
			\dash\header::status(404, T_("ID not found"));
		}

		\dash\data::editMode(true);

		\dash\data::dataRow($load);

		\dash\data::myType(a($load, 'tax_document', 'template'));

		\dash\allow::file();


	}
}
?>