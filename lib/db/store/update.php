<?php
namespace lib\db\store;


class update
{
	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('store', $_args, $_id, 'master');

	}

	public static function store_data($_field, $_value, $_store_id)
	{
		$query  = "UPDATE store_data SET store_data.$_field = '$_value' WHERE store_data.id = $_store_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;

	}

    public static function record_data($_args, $_id)
    {
        return \dash\pdo\query_template::update('store_data', $_args, $_id, 'master');

    }




	public static function owner($_owner, $_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store_data SET store_data.owner = '$_owner', store_data.datemodified = '$date' WHERE store_data.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}

	public static function subdomain($_subdomain, $_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store SET store.subdomain = '$_subdomain', store.datemodified = '$date' WHERE store.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function set_deleted($_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store SET store.status = 'deleted', store.datemodified = '$date' WHERE store.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function set_transfer($_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store SET store.status = 'transfer', store.datemodified = '$date' WHERE store.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}



	public static function set_enable($_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store SET store.status = 'enable', store.datemodified = '$date' WHERE store.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function new_fuel($_id, $_new_fuel)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store SET store.fuel = '$_new_fuel', store.datemodified = '$date' WHERE store.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}

	public static function enterprise($_enterprise, $_id)
	{
		$date = date("Y-m-d H:i:s");
		if($_enterprise)
		{
			$enterprise = " store_data.enterprise = '$_enterprise' ";
		}
		else
		{
			$enterprise = " store_data.enterprise = NULL ";
		}
		$query  = "UPDATE store_data SET $enterprise, store_data.datemodified = '$date' WHERE store_data.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;

	}


	public static function storage($_storage, $_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store_data SET store_data.storage = $_storage , store_data.datemodified = '$date' WHERE store_data.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function uploadsize($_uploadsize, $_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store_data SET store_data.uploadsize = $_uploadsize , store_data.datemodified = '$date' WHERE store_data.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}



	public static function branding($_expire_branding, $_id)
	{
		$date   = date("Y-m-d H:i:s");
		$query  = "UPDATE store_data SET store_data.branding = '$_expire_branding' , store_data.datemodified = '$date' WHERE store_data.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}



}
?>