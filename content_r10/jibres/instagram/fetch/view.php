<?php
namespace content_r10\jibres\instagram\fetch;


class view
{
	public static function config()
	{
		$access_token = \dash\request::get('access_token');
		$user_id      = \dash\request::get('user_id');
		$result       = [];

		if(!$access_token || !$user_id)
		{
			\dash\notif::error(T_("access_token and user id is required"));
		}


		$media = \lib\api\instagram\api::getUserMedia($access_token, $user_id);

		if(isset($media['data']))
		{
			$result = $media['data'];
		}
		else
		{
			\dash\notif::error(T_("Can not get instagram data"));

		}


		\content_r10\tools::say($result);
	}
}
?>