<?php
namespace content_r10\jibres\twitter\lookup;


class view
{
	public static function config()
	{
		$result   = [];

		$username = \dash\validate::socialnetwork(\dash\request::get('username'), false);
		$tweet_id = \dash\validate::socialnetwork(\dash\request::get('tweet_id'), false);


		if(!$username)
		{
			\dash\notif::error(T_('Invalid username'));
			return false;
		}

		if(!$tweet_id)
		{
			\dash\notif::error(T_('Invalid tweet_id'));
			return false;
		}

		$result = \lib\api\twitter\api::lookup_tweet_by_username_id($username, $tweet_id);

		\content_r10\tools::say($result);
	}
}
?>