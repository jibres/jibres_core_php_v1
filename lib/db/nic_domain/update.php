<?php
namespace lib\db\nic_domain;


class update
{


	public static function update_by_domain($_args, $_domain)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE domain SET $set WHERE domain.name = '$_domain' ";
		$result = \dash\pdo::query($query, [], 'nic');
		return $result;
	}

	public static function update($_args, $_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");

		return \dash\pdo\query_template::update('domain', $_args, $_id, 'nic');
	}

	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('domain', $_args, $_id, 'nic');
	}


	public static function update_by_dumain($_args, $_domain)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}
		$query  = "UPDATE domain SET $set WHERE domain.name = '$_domain' ";
		$result = \dash\pdo::query($query, [], 'nic');
		return $result;
	}


	public static function remove_lastfetch_domain($_domain)
	{
		$query  = "UPDATE domain SET domain.lastfetch = NULL WHERE domain.name = '$_domain' ";
		$result = \dash\pdo::query($query, [], 'nic');
		return $result;
	}



	public static function remove_old_default($_user_id)
	{
		$query  = "UPDATE domain SET domain.isdefault = NULL WHERE domain.user_id = $_user_id";
		$result = \dash\pdo::query($query, [], 'nic');
		return $result;
	}


	public static function remove_verify_from_all($_domain)
	{
		$query  = "UPDATE domain SET domain.verify = NULL, domain.email = NULL, domain.mobile = NULL WHERE domain.name = '$_domain' ";
		$result = \dash\pdo::query($query, [], 'nic');
		return $result;
	}



}
?>