<?php
namespace content_crm\ticket\view;


class controller
{
	public static function routing()
	{

		$id = \dash\request::get('id');
		$load = \dash\app\ticket\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		if(isset($load['parent']) && $load['parent'])
		{
			\dash\redirect::to(\dash\url::this(). '/view?id='. $load['parent']);
		}

		\dash\data::dataRow($load);
	}
}
?>
