<?php
namespace lib\db\store_domain;


class get
{

	public static function reset_cronjob_list()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM store_domain WHERE store_domain.status != 'ok' AND store_domain.cronjobdate IS NOT NULL ";
		$result_is_not_null = \dash\db::get($query, 'count', true, 'master');

		$query  = "SELECT COUNT(*) AS `count` FROM store_domain WHERE store_domain.status != 'ok' ";
		$result_all = \dash\db::get($query, 'count', true, 'master');

		if($result_is_not_null === $result_all || true)
		{
			$query  = "UPDATE store_domain SET store_domain.cronjobdate = NULL WHERE store_domain.status != 'ok' AND store_domain.cronjobdate IS NOT NULL ";
			$query  = "UPDATE store_domain SET store_domain.cronjobdate = NULL WHERE 1 ";
			$result = \dash\db::query($query, 'master');
			return $result;
		}

	}

	public static function cronjob_list_new()
	{

		$query  = "SELECT * FROM store_domain WHERE store_domain.status != 'ok' AND store_domain.cronjobdate IS NULL ORDER BY store_domain.datemodified DESC, store_domain.id ASC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}

	public static function cronjob_list_ssl($_date)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.status != 'ok' AND store_domain.sslfailed IS NULL AND store_domain.sslrequestdate IS NOT NULL AND store_domain.sslrequestdate < '$_date' ORDER BY store_domain.cronjobdate DESC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}

	public static function cronjob_list_other()
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.status != 'ok' AND store_domain.sslrequestdate IS NULL ORDER BY store_domain.datemodified DESC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}

	public static function check_duplicate($_domain)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.domain = '$_domain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function by_domain($_domain)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.domain = '$_domain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function by_store_id($_store_id)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.store_id = $_store_id ORDER BY store_domain.master desc";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function master_domain($_store_id)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.store_id = $_store_id AND store_domain.master = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}




	public static function is_customer_domain($_domain)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.domain = '$_domain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


}
?>
