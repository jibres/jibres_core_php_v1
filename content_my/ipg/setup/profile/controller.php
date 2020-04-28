<?php
namespace content_my\ipg\setup\profile;


class controller
{
	public static function routing()
	{
		$type = \dash\validate::enum(\dash\request::get('type'), false, ['enum' => ['real', 'legal']]);
		if(!$type)
		{
			\dash\redirect::to(\dash\url::that(). '/type');
		}
	}
}
?>