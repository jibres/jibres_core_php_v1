<?php
namespace dash\db\posts;


class get
{
	public static function by_id_type(int $_id, string $_type)
	{
		$query  = "SELECT * FROM posts WHERE posts.id = $_id AND posts.type = '$_type' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function have_any_published_post()
	{
		$query  = "SELECT * FROM posts WHERE posts.status = 'publish' AND posts.type != 'pagebuilder' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function sitemap_list($_from, $_to, $_lang = null)
	{
		$lang = null;
		if($_lang)
		{
			$lang = " AND posts.language = '$_lang' ";
		}
		$query  =
		"
			SELECT
				posts.id,
				posts.url,
				posts.slug,
				posts.specialaddress,
				IFNULL(posts.datemodified, posts.datecreated) AS `datemodified`
			FROM
				posts
			WHERE
				posts.status = 'publish' AND
				posts.id >= $_from AND
				posts.id < $_to
				$lang
		";

		$result = \dash\db::get($query);

		return $result;
	}


	public static function check_duplicate_url_in_posts($_url, $_id = null)
	{
		$check_id = null;
		if($_id)
		{
			$check_id = " AND posts.id != $_id ";
		}

		$query  = "SELECT * FROM posts WHERE posts.url = '$_url' $check_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function list_all_of_pages($_current_id)
	{
		$query  = "SELECT posts.id, posts.title, posts.parent FROM posts WHERE posts.specialaddress = 'special' AND posts.status = 'publish' AND posts.id != $_current_id ";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function by_id($_id)
	{
		$query  = "SELECT * FROM posts WHERE posts.id = $_id  LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_ids($_ids)
	{
		$query  = "SELECT * FROM posts WHERE posts.id IN ($_ids) ";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_duplicate($_slug, $_language)
	{
		$query  = "SELECT * FROM posts WHERE posts.slug = '$_slug' AND posts.language = '$_language' LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_duplicate_slug($_slug)
	{
		$query  = "SELECT * FROM posts WHERE posts.slug = '$_slug' LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_one($_args)
	{
		$where  = \dash\db\config::make_where($_args);
		$query  = "SELECT * FROM posts WHERE $where LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function chart_by_date_fa($_enddate, $_month_list, $_status)
	{
		$CASE = [];
		foreach ($_month_list as $month => $date)
		{
			$CASE[] = "WHEN posts.datecreated >= '$date[0] 00:00:00' AND posts.datecreated <= '$date[1] 23:59:59' THEN '$month'";
		}

		$CASE = " CASE ". implode(" ", $CASE). "  ELSE '0' END ";


		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				$CASE AS `month`
			FROM
				posts
			WHERE
				posts.status = '$_status' AND
				posts.datecreated >= '$_enddate'
			GROUP BY $CASE
		";

		$result = \dash\db::get($query, ['month', 'count']);

		return $result;
	}



	public static function chart_by_date_en($_enddate, $_status)
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				MONTH(posts.datecreated) AS `month`
			FROM
				posts
			WHERE
				posts.status = '$_status' AND
				posts.datecreated >= '$_enddate'
			GROUP BY MONTH(posts.datecreated)
		";

		$result = \dash\db::get($query, ['month', 'count']);

		return $result;
	}

}
?>