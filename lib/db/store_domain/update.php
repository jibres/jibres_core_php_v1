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


	public static function change_master($_store_id, $_master_domain)
	{
		$query = "UPDATE store_domain SET store_domain.master = NULL WHERE store_domain.store_id = $_store_id ";
		$result = \dash\db::query($query, 'master');
		if($result)
		{
			$query = "UPDATE store_domain SET store_domain.master = 1 WHERE store_domain.store_id = $_store_id  AND store_domain.domain = '$_master_domain' LIMIT 1";
			$result = \dash\db::query($query, 'master');
		}

		return $result;

	}

}
?>
