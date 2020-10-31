<?php
namespace content_a\form\tag;

class controller
{
	public static function routing()
	{
		\content_a\form\tag\controller::check_form_id();

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