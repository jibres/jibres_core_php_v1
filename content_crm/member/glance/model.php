<?php
namespace content_crm\member\glance;


class model
{

	public static function post()
	{

		if(\dash\request::post('resetban') === 'resetban')
		{
			$post =
			[
				'status' => 'awaiting',
				'ban_expire' => null,
			];

			\dash\app\user::edit($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}





	}
}
?>