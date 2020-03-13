<?php
namespace content_account\api;


class model
{
	public static function post()
	{
		if(!\dash\user::id())
		{
			return;
		}


		$condition =
		[
			'add'    => ['enum' => ['apikey']],
			'remove' => ['enum' => ['apikey']],
		];

		$args =
		[
			'add'    => \dash\request::post('add'),
			'remove' => \dash\request::post('remove'),
		];

		$require = [];
		$meta    = ['field_title' => ['add' => 'apikey']];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		if($data['add'] === 'apikey')
		{
			$check = \dash\app\user_auth::make_user_auth(\dash\user::id(), 'api');
			if($check)
			{
				\dash\log::set('createNewApiKey');
				\dash\notif::ok(T_("Creat new api key successfully complete"));
				\dash\redirect::pwd();
			}
			else
			{
				\dash\notif::error(T_("Error in create new api key"));
			}
		}
		elseif($data['remove'] === 'apikey')
		{
			$check = \dash\app\user_auth::disable_api_key(\dash\user::id(), 'api');
			if($check)
			{
				\dash\log::set('RemoveApiKey');
				\dash\notif::ok(T_("Your api key was removed"));
				\dash\redirect::pwd();
			}
			else
			{
				\dash\notif::error(T_("Error in remove api key"));
			}
		}
	}
}
?>