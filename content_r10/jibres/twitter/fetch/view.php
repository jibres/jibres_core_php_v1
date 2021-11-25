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

		$result = \lib\api\twitter\api::timelines_by_username($username, $args);

		\content_r10\tools::say($result);
	}
}
?>