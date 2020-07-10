<?php
namespace content_a\order\detail;


class model
{

	public static function post()
	{

		$post           = [];
		$post['action'] = \dash\request::post('orderaction');
		$post['desc']   = \dash\request::post('desc');
		$post['file']   = \dash\upload\factor::factor_action(\lib\app\factor\get::fix_id(\dash\request::get('id')));


		\lib\app\factor\action::add($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
