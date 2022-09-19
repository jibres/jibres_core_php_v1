<?php
namespace content_a\form\tag;

class controller
{
	public static function routing()
	{
		\content_a\form\tag\controller::check_form_id();

		$id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}
		\dash\data::dataRow($load);

	}

	public static function check_form_id()
	{
		$id = \dash\request::get('id');
		if(!$id)
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>