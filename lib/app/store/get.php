<?php
namespace lib\app\store;


class get
{

	public static function subdomain($_subdomain)
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
}
?>