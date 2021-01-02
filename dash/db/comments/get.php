<?php
namespace dash\db\comments;


class get
{
	public static function customer_review_product($_product_id)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				AVG(comments.star) AS `avg`,
				SUM(CASE WHEN comments.star = 1 THEN 1 ELSE 0 END) 'star_1',
				SUM(CASE WHEN comments.star = 2 THEN 1 ELSE 0 END) 'star_2',
				SUM(CASE WHEN comments.star = 3 THEN 1 ELSE 0 END) 'star_3',
				SUM(CASE WHEN comments.star = 4 THEN 1 ELSE 0 END) 'star_4',
				SUM(CASE WHEN comments.star = 5 THEN 1 ELSE 0 END) 'star_5'

			FROM
				comments
			WHERE
				comments.status     = 'approved' AND
				(
					comments.product_id = $_product_id OR
					comments.product_id IN (SELECT products.id FROM products WHERE products.parent = $_product_id) OR
					comments.product_id IN (SELECT products.id FROM products WHERE products.parent = (SELECT products.parent FROM products WHERE products.id = $_product_id))
				)

		";
		$result = \dash\db::get($query, null, true);

		return $result;
	}


	public static function customer_review_post($_post_id)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				AVG(comments.star) AS `avg`,
				SUM(CASE WHEN comments.star = 1 THEN 1 ELSE 0 END) 'star_1',
				SUM(CASE WHEN comments.star = 2 THEN 1 ELSE 0 END) 'star_2',
				SUM(CASE WHEN comments.star = 3 THEN 1 ELSE 0 END) 'star_3',
				SUM(CASE WHEN comments.star = 4 THEN 1 ELSE 0 END) 'star_4',
				SUM(CASE WHEN comments.star = 5 THEN 1 ELSE 0 END) 'star_5'

			FROM
				comments
			WHERE
				comments.status     = 'approved' AND
				comments.post_id = $_post_id

		";
		$result = \dash\db::get($query, null, true);

		return $result;
	}


	public static function product_comment_count($_product_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM comments WHERE comments.product_id = $_product_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


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
				users.displayname AS `user_displayname`,
				users.mobile AS `user_mobile`,
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



	public static function answer_count($_parent)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM comments WHERE comments.parent = $_parent";
		$result = \dash\db::get($query, 'count', true);
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