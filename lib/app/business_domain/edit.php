<?php
namespace lib\app\business_domain;


class edit
{
	public static function set_date($_id, $_field)
	{
		$result = \lib\db\business_domain\update::update([$_field => date("Y-m-d H:i:s")], $_id);
	}

	public static function unset_date($_id, $_field)
	{
		$result = \lib\db\business_domain\update::update([$_field => null], $_id);
	}
}
?>