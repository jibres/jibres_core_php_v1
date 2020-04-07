<?php
namespace content_my\domain\irnic\edit;


class model
{
	public static function post()
	{
		// if(\dash\request::post('check') === 'again')
		// {
		// 	$update = \lib\app\nic_contact\edit::update(\dash\request::get('id'));

		// 	if(\dash\engine\process::status())
		// 	{
		// 		\dash\redirect::pwd();
		// 	}
		// 	return;
		// }

		if(\dash\request::post('myaction') === 'remove')
		{
			if(\dash\url::isLocal())
			{
				$get_api = new \lib\nic\api();
				$remove  = $get_api->contact_remove(\dash\request::get('id'));
			}
			else
			{
				$remove = \lib\app\nic_contact\edit::remove(\dash\request::get('id'));
			}

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

		if(\dash\url::isLocal())
		{
			$get_api = new \lib\nic\api();
			$edit  = $get_api->contact_edit($post, \dash\request::get('id'));
		}
		else
		{
			$edit = \lib\app\nic_contact\edit::edit($post, \dash\request::get('id'));
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}



	}
}
?>