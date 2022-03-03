<?php
namespace content_business\author;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();

		$allow = false;

		if($child)
		{
			$user_id = \dash\url::child();
			$user_id = \dash\validate::code($user_id);



			if($user_id)
			{
				$args =
				[
					'user'       => $user_id,
				];

				$myPostList = \dash\app\posts\search::website_post(null, $args);

				if($myPostList)
				{
					\dash\data::myPostList($myPostList);

					\dash\open::get();

					$allow = true;
				}
			}
		}

		if(!$allow)
		{
			\dash\redirect::to(\dash\url::kingdom());
			return false;
		}

	}
}
?>