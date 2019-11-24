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
			'displayname' => \dash\request::post('displayname'),
			'birthday'    => \dash\request::post('birthday'),
			'gender'      => \dash\request::post('gender'),

		];

		return $post;
	}



	public static function post()
	{

		$request = self::getPost();

		// ready request
		$id = \dash\user::id();
		$id = \dash\coding::encode($id);
		$result = \dash\app\user::edit($request, $id);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::ok(T_("Your profile successfully updated"));
			\dash\log::set('editProfile', ['code' => \dash\user::id()]);
			\dash\user::refresh();

			// save every field in somewhere and set the owner detail is complete
			$next_level = \lib\app\setting\setup::owner();
			\dash\redirect::to($next_level);
		}
	}
}
?>
