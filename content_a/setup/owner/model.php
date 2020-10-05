<?php
namespace content_a\setup\owner;


class model
{

	public static function getPost()
	{
		$post =
		[
			'firstname'   => \dash\request::post('firstname'),
			'lastname'    => \dash\request::post('lastname'),
			'birthday'    => \dash\request::post('birthday'),
			'gender'      => \dash\request::post('gender'),

		];

		if(!$post['gender'])
		{
			\dash\notif::error(T_("Please set your gender"), 'gender');
			return false;
		}

		if(!$post['firstname'])
		{
			\dash\notif::error(T_("Please set your firstname"), 'firstname');
			return false;
		}

		if(!$post['lastname'])
		{
			\dash\notif::error(T_("Please set your lastname"), 'lastname');
			return false;
		}


		return $post;
	}



	public static function post()
	{

		$request = self::getPost();

		if($request === false)
		{
			return false;
		}

		// ready request
		$id = \dash\user::id();
		$id = \dash\coding::encode($id);
		$result = \dash\app\user::edit($request, $id);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\log::set('editProfileInSetup', ['code' => \dash\user::id()]);


			// save every field in somewhere and set the owner detail is complete
			$next_level = \lib\app\setting\setup::owner();
			\dash\redirect::to($next_level);
		}
	}
}
?>
