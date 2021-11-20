<?php
namespace content_r10\jibres\instagram\login;


class view
{
	public static function config()
	{
		$business_id = \content_r10\tools::get_current_business_id();

		$url         = \lib\app\instagram\get::login_url($business_id);

		$result              = [];
		$result['login_url'] = $url;


		\content_r10\tools::say($result);
	}
}
?>