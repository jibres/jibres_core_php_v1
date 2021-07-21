<?php
namespace content_a\accounting\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');

		$check_need_welcome_message = \content_a\accounting\welcome\controller::check_need_welcome_message();
		if($check_need_welcome_message)
		{
			\dash\redirect::to(\dash\url::this(). '/welcome');
		}
	}
}
?>