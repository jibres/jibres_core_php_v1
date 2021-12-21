<?php
namespace lib\db\discount;


class get
{

	public static function count_all()
	{
		$query = "SELECT COUNT(*) AS `count` FROM discount ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function check_duplicate_code($_code)
	{
		$query = "SELECT * FROM discount WHERE discount.code = '$_code' LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM discount WHERE discount.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function by_code($_code)
	{
		$query = "SELECT * FROM discount WHERE discount.code = '$_code' LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


}
?>
