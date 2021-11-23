<?php
namespace content_a\setting\tw;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Twitter'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social');



		$twitter_last_fetch = \lib\app\twitter\business::last_fetch();
		\dash\data::twitterLastFetch($twitter_last_fetch);

		$twitter_posts = \lib\app\twitter\business::get_my_posts();
		\dash\data::myTwitterPosts($twitter_posts);


	}
}
?>