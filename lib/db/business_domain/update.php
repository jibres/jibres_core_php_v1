<?php
namespace lib\db\business_domain;


class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if($set)
		{
			$query = " UPDATE `business_domain` SET $set WHERE business_domain.id = $_id LIMIT 1 ";
			return \dash\db::query($query, 'master');
		}
		else
		{
			return false;
		}
	}

}
?>
