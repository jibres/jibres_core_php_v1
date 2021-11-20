<?php
namespace content_a\setting\instagram;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Instagram'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social');


		$instagram_user_id = \lib\app\instagram\get::user_id();
		\dash\data::instagramUserId($instagram_user_id);


		$instagram_access_token = \lib\app\instagram\get::access_token();
		\dash\data::instagramAccessToken($instagram_access_token);



		if($instagram_access_token)
		{
			$myPosts = \lib\app\instagram\get::get_my_posts();
			\dash\data::myInstagramPosts($myPosts);
		}


	}
}
?>