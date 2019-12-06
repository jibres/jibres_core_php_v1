<?php
namespace lib\app\store;


class get
{

	public static function by_subdomain($_subdomain)
	{
		if($_subdomain && is_string($_subdomain))
		{
			$subdomain_detail = \lib\db\store\get::subdomain_detail($_subdomain);
			if($subdomain_detail)
			{
				return $subdomain_detail;
			}
		}

		return null;
	}


	public static function by_id($_by_id)
	{
		if($_by_id && is_numeric($_by_id))
		{
			$by_id_detail = \lib\db\store\get::id_detail($_by_id);
			if($by_id_detail)
			{
				return $by_id_detail;
			}
		}

		return null;
	}


	public static function data_by_id($_id)
	{
		if($_id && is_numeric($_id))
		{
			$result = \lib\db\store\get::data($_id);
			return $result;
		}
		return false;
	}
}
?>