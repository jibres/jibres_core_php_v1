<?php
namespace lib\db\factoraction;


class get
{

	public static function one($_id)
	{
		$query = "SELECT * FROM factoraction WHERE id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_id_factor_id($_id, $_factor_id)
	{
		$query = "SELECT * FROM factoraction WHERE id = $_id AND factoraction.factor_id = $_factor_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_by_factor_id($_factor_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM factoraction WHERE factoraction.factor_id = $_factor_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function by_action_factor_id($_factor_id, $_action)
	{
		$query = "SELECT * FROM factoraction WHERE factoraction.factor_id = $_factor_id AND factoraction.action = '$_action' LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function all_by_factor_id_public($_id)
	{
		$query =
		"
			SELECT
				factoraction.*,
				users.displayname,
				users.avatar,
				users.gender,
				users.mobile
			FROM
				factoraction
			LEFT JOIN users ON users.id = factoraction.user_id
			WHERE factoraction.factor_id = $_id AND factoraction.action != 'comment'
			ORDER BY factoraction.id DESC
		";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function all_by_factor_id($_id)
	{
		$query =
		"
			SELECT
				factoraction.*,
				users.displayname,
				users.avatar,
				users.gender,
				users.mobile
			FROM
				factoraction
			LEFT JOIN users ON users.id = factoraction.user_id
			WHERE factoraction.factor_id = $_id
			ORDER BY factoraction.id DESC
		";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>