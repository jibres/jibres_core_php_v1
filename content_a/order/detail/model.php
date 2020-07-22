<?php
namespace content_a\order\detail;


class model
{

	public static function post()
	{
		if(\dash\request::post('removeorder') === 'removeorder')
		{
			\lib\app\factor\remove::remove(\dash\request::get('id'));
			\dash\redirect::to(\dash\url::this());
			return;
		}

		$post           = [];
		$post['action'] = \dash\request::post('orderaction');
		$post['desc']   = \dash\request::post('desc');
		if(\dash\request::files('file'))
		{
			$post['file']   = \dash\upload\factor::factor_action(\lib\app\factor\get::fix_id(\dash\request::get('id')));
		}


		\lib\app\factor\action::add($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
