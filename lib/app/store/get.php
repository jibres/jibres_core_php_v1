<?php
namespace lib\app\store;


class get
{

	public static function by_subdomain($_subdomain)
	{
		$_subdomain = \dash\validate::subdomain($_subdomain, false);
		if($_subdomain)
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
		$_id = \dash\validate::id($_by_id, false);

		if($_by_id && is_numeric($_by_id))
		{
			$by_id_detail = \lib\db\store\get::detail($_by_id);
			if($by_id_detail)
			{
				return $by_id_detail;
			}
		}

		return null;
	}


	public static function data_by_id($_id)
	{
		$_id = \dash\validate::id($_id, false);

		if($_id && is_numeric($_id))
		{
			$result = \lib\db\store\get::data($_id);
			return $result;
		}
		return false;
	}
}
?>