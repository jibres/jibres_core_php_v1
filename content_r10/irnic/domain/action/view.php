<?php
namespace content_r10\irnic\domain\action;


class view
{
	public static function config()
	{
		$id    = \dash\request::get('id');

		$args =
		[
			'domain_id' => $id,
		];

		$list = \lib\app\nic_domainaction\search::list(null, $args);

		\content_r10\tools::say($list);
	}
}
?>