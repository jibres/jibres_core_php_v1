<?php
namespace content_b1\category\photo;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');
		$id = \dash\validate::id($id);

		$args             = [];

		$file = \dash\upload\category::set($id);

		if($file)
		{
			$args['file'] = $file;
		}

		$result = \lib\app\category\edit::edit($args, $id);

		\content_b1\tools::say($result);
	}


	public static function delete()
	{
		$id = \dash\request::get('id');
		$id = \dash\validate::id($id);

		\lib\app\category\remove::remove_file($id);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Category file deleted"));
		}

		\content_b1\tools::say(true);
	}

}
?>