<?php
namespace dash\db\comments;


class get
{
	public static function by_id($_id)
	{
		$query  = "SELECT * FROM comments WHERE comments.id = $_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function full_by_id($_id)
	{
		$query  =
		"
			SELECT
				comments.*,
				users.displayname AS `displayname`,
				users.mobile AS `mobile`,
				users.avatar AS `avatar`,
				products.title AS `product_title`,
				products.thumb AS `product_thumb`
			FROM
				comments
			LEFT JOIN users ON users.id = comments.user_id
			LEFT JOIN products ON products.id = comments.product_id
			WHERE
				comments.id = $_id
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);

		return $result;
	}




	public static function get_one($_args)
	{
		$where  = \dash\db\config::make_where($_args);
		$query  = "SELECT * FROM comments WHERE $where LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

}
?>