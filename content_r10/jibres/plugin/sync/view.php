<?php
namespace content_r10\jibres\premium\sync;


class view
{
	public static function config()
	{
		$business_id   = \content_r10\tools::get_current_business_id();

		$result = \lib\app\premium\business::list($business_id);

		\dash\notif::complete();

		\content_r10\tools::say($result);
	}
}
?>