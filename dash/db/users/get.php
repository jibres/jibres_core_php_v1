<?php
namespace dash\db\users;


class get
{
	public static function check_duplicate_accounting_detail($_accounting_detail_id)
	{
		$query  = "SELECT users.id AS `id` FROM users WHERE users.accounting_detail_id = '$_accounting_detail_id' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function jibres_user_id($_mobile)
	{
		$query  = "SELECT users.id AS `id` FROM users WHERE users.mobile = '$_mobile' LIMIT 1";
		$result = \dash\db::get($query, 'id', true, 'master');
		return $result;
	}


	public static function by_multi_id($_ids)
	{
		$query  = "SELECT *  FROM users WHERE users.id IN ($_ids) ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function by_multi_id_for_view($_ids)
	{
		$query  = "SELECT users.id, users.mobile, users.avatar, users.displayname, users.gender  FROM users WHERE users.id IN ($_ids) ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function group_by_permission()
	{
		$query  = "SELECT COUNT(*) AS `count`, users.permission  FROM users WHERE users.permission IS NOT NULL GROUP BY users.permission ";
		$result = \dash\db::get($query, ['permission', 'count']);
		return $result;
	}



	public static function count_all()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM users ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function all_record_for_export()
	{
		$query  = "SELECT * FROM users ORDER BY users.id ASC ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function export_list($_start_limit, $_end_limit)
	{
		$query  = "SELECT * FROM users ORDER BY users.id ASC LIMIT $_start_limit, $_end_limit";
		$result = \dash\pdo::get($query);
		return $result;
	}



	public static function last_user_id_fuel_db_name($_fuel, $_db_name)
	{
		$query  = "SELECT users.id AS `id` FROM users ORDER BY users.id DESC LIMIT 1";
		$result = \dash\db::get($query, 'id', true, $_fuel, ['database' => $_db_name]);
		return $result;
	}
}
?>