<?php
namespace content_r10\domain\remove;


class model
{
	public static function delete()
	{
		$result = \lib\app\nic_domain\remove::remove(\lib\app\domains\get::my_domain_id_api());
		\content_r10\tools::say($result);
	}

}
?>