<?php
namespace lib\db\store;


class check
{
	public static function duplicate_slug($_slug)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_slug' LIMIT 1";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}
}
?>