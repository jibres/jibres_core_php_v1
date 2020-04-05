<?php
namespace lib\db\store_domain;


class update
{

	public static function record($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if($set && $_id && is_numeric($_id))
		{
			// make update query
			$query = "UPDATE store_domain SET $set WHERE store_domain.id = $_id LIMIT 1";
			return \dash\db::query($query, 'master');
		}
	}

}
?>
