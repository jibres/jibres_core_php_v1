<?php
namespace lib\db\gift;


class get
{
	public static function by_id($_id)
	{
		$query  = "SELECT * FROM gift WHERE gift.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_code($_code)
	{
		$query  = "SELECT * FROM gift WHERE gift.code = '$_code' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_duplicate_code($_code)
	{
		$query  = "SELECT * FROM gift WHERE gift.code = '$_code' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_usaget_gift_id($_gift_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftusage WHERE giftusage.gift_id = $_gift_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_usaget_gift_id_user_id($_gift_id, $_user_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM giftusage WHERE giftusage.gift_id = $_gift_id AND giftusage.user_id = $_user_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_usaget_gift_id_user_id_by_category($_user_id, $_category)
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				giftusage
			WHERE
				giftusage.user_id = $_user_id AND
				giftusage.gift_id IN (SELECT gift.id FROM gift WHERE gift.category = '$_category')
		";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}




	public static function category_list()
	{
		$query  = "SELECT DISTINCT gift.category AS `category` FROM gift WHERE gift.category IS NOT NULL";
		$result = \dash\db::get($query, 'category');
		return $result;

	}



}
?>