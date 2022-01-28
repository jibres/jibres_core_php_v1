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
		$query = "SELECT * FROM discount WHERE discount.code = :code AND discount.status = :status LIMIT 1";
		$param =
		[
			':status' => 'enable',
			':code'   => $_code,
		];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM discount WHERE discount.id = :id LIMIT 1";
		$param = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function by_code($_code)
	{
		$query = "SELECT * FROM discount WHERE discount.code = :code LIMIT 1";
		$param = [':code' => $_code];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


}
?>
