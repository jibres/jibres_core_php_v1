<?php
namespace lib\db\store_domain;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM store_domain WHERE store_domain.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;
	}

}
?>
