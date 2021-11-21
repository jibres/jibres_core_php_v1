<?php
namespace content_a\setting\instagram;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Instagram'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social');


		$instagram_user_id = \lib\app\instagram\business::user_id();
		\dash\data::instagramUserId($instagram_user_id);


		$instagram_access_token = \lib\app\instagram\business::access_token();
		\dash\data::instagramAccessToken($instagram_access_token);


		\lib\app\instagram\business::get_my_posts();

	}
}
?>