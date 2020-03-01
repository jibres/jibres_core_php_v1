<?php
namespace lib\db\nic_poll;


class get
{


	public static function my_list($_user_id)
	{
		$my_domain = "SELECT domain.name FROM domain WHERE domain.status != 'deleted' AND domain.user_id = $_user_id";
		$my_domain = \dash\db::get($my_domain, 'name', false, 'nic');
		$my_domain = array_filter($my_domain);
		$my_domain = array_unique($my_domain);
		if($my_domain)
		{
			$my_domain = implode("','", $my_domain);

			$my_poll = "SELECT * FROM poll WHERE poll.domain IN ('$my_domain')";

			$my_poll = \dash\db::get($my_poll, null, false, 'nic');
			return $my_poll;
		}

		return [];
	}
}
?>
