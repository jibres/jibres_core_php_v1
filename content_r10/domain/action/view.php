<?php
namespace content_r10\domain\action;


class view
{
	public static function config()
	{
		$id    = \dash\request::get('id');

		$args =
		[
			'user_id' => \dash\user::id(),
			'domain_id' => \lib\app\domains\get::my_domain_id_api(),
		];


		$list = \lib\app\nic_domainaction\search::list(null, $args);

		\content_r10\tools::say($list);
	}
}
?>