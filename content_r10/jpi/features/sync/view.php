<?php
namespace content_r10\jpi\features\sync;


class view
{
	public static function config()
	{
		$business_id   = \content_r10\tools::get_current_business_id();

		$result = \lib\features\business::list($business_id);

		\dash\notif::complete();

		\content_r10\tools::say($result);
	}
}
?>