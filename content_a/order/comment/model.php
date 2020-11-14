<?php
namespace content_a\order\comment;


class model
{

	public static function post()
	{

		if(\dash\request::post('editdesc') === 'editdesc')
		{
			$post =
			[
				'desc' => \dash\request::post('desc'),
			];


			\lib\app\factor\edit::edit_factor($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}


		if(\dash\request::post('removeaction') === 'removeaction')
		{
			\lib\app\factor\action::remove(\dash\request::post('actionid'), \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}


		$post           = [];
		$post['action'] = 'comment';
		$post['desc']   = \dash\request::post('cdesc');

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
