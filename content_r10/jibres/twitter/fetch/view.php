<?php
namespace content_r10\jibres\twitter\fetch;


class view
{
	public static function config()
	{
		$result   = [];

		$username = \dash\validate::socialnetwork(\dash\request::get('username'), false);

		$args =
		[
			'count'    => \dash\validate::smallint(\dash\request::get('count'), false),
		];


		if(!$username)
		{
			\dash\notif::error(T_('Invalid username'));
			return false;
		}

		$tweet = \lib\api\twitter\api::timelines_by_username($username, $args);

		if(isset($tweet['data']))
		{
			$result = $tweet['data'];
		}
		else
		{
			\dash\notif::error(T_("Can not get twitter data"));

		}


		\content_r10\tools::say($result);
	}
}
?>