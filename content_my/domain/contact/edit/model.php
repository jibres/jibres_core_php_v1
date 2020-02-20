<?php
namespace content_my\domain\contact\edit;


class model
{
	public static function post()
	{
		if(\dash\request::post('check') === 'again')
		{
			$update = \lib\app\nic_contact\edit::update(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('myaction') === 'remove')
		{
			$remove = \lib\app\nic_contact\edit::remove(\dash\request::get('id'));

			if(\dash\engine\process::status() && $remove)
			{
				\dash\redirect::to(\dash\url::that());
			}
			return;
		}

		$post =
		[
			'title'     => \dash\request::post('title'),
			'isdefault' => \dash\request::post('isdefault'),
		];

		$edit = \lib\app\nic_contact\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}



	}
}
?>