<?php
namespace content_r10\irnic\domain\history;


class view
{
	public static function config()
	{
		$list = \lib\app\nic_domainaction\search::all_list(null, []);

		\content_r10\tools::say($list);
	}
}
?>