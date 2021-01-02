<?php
namespace lib\db\producttag;


class get
{

	public static function sitemap_list($_from, $_to)
	{
		$query  =
		"
			SELECT
				producttag.id,
				producttag.slug,
				IFNULL(producttag.datemodified, producttag.datecreated) AS `datemodified`
			FROM
				producttag
			WHERE
				producttag.id >= $_from AND
				producttag.id < $_to
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function all_tag()
	{

		$query  = "SELECT producttag.id, producttag.title FROM producttag ";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function mulit_title($_titles)
	{
		if(!is_array($_titles) || !$_titles)
		{
			return false;
		}

		$_titles = implode("','", $_titles);

		$query =
		"
			SELECT *
			FROM producttag
			WHERE
				producttag.title IN ('$_titles')
		";
		$result = \dash\db::get($query);

		return $result;
	}


	public static function one($_id)
	{
		$query  =
		"
			SELECT
				(SELECT COUNT(*) AS `count` FROM producttagusage WHERE  producttagusage.producttag_id = producttag.id) AS `count`,
				producttag.*
			FROM
				producttag
			WHERE
				producttag.id = $_id
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function get_count_product($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM producttagusage WHERE  producttagusage.producttag_id = $_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query  = "SELECT * FROM producttag WHERE producttag.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_slug($_slug)
	{
		$query  = "SELECT * FROM producttag WHERE producttag.slug = '$_slug' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_all()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM producttag ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function check_unique_slug($_slug)
	{
		$query  = "SELECT * FROM producttag WHERE producttag.slug = '$_slug'  LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_duplicate($_slug, $_language)
	{
		$query  = "SELECT * FROM producttag WHERE producttag.slug = '$_slug' AND producttag.language = '$_language' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function check_duplicate_title($_title)
	{
		$query  = "SELECT * FROM producttag WHERE producttag.title = '$_title'  LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
