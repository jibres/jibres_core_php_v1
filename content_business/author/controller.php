<?php
namespace content_business\author;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();

		if(!$child)
		{
			\dash\redirect::to(\dash\url::kingdom());
			return false;
		}

		$user_id = \dash\url::child();
		$user_id = \dash\validate::code($user_id);

		if($user_id)
		{
			\dash\data::myAuthor($user_id);

			\dash\open::get();
		}

	}
}
?>