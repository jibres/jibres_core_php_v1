<?php
namespace dash\db\terms;

class get
{
	public static function sitemap_list($_from, $_to, $_lang = null)
	{
		$lang = null;
		if($_lang)
		{
			$lang = " AND terms.language = '$_lang' ";
		}

		$query  =
		"
			SELECT
				terms.id,
				terms.url,
				IFNULL(terms.datemodified, terms.datecreated) AS `datemodified`
			FROM
				terms
			WHERE
				terms.id >= $_from AND
				terms.id < $_to
				$lang
		";

		$result = \dash\pdo::get($query);

		return $result;
	}

	public static function get_raw()
	{
		return \dash\pdo\query_template::get_where('terms', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\pdo\query_template::get_count('terms', ...func_get_args());
	}

	public static function mulit_title($_titles, $_type)
	{
		if(!is_array($_titles) || !$_titles)
		{
			return false;
		}

		$_titles = implode("','", $_titles);

		$query =
		"
			SELECT *
			FROM terms
			WHERE
				terms.type = '$_type' AND
				terms.title IN ('$_titles')
		";
		$result = \dash\pdo::get($query);

		return $result;
	}


	public static function check_duplicate_url_in_terms($_url, $_id = null)
	{
		$check_id = null;
		if($_id)
		{
			$check_id = " AND terms.id != $_id ";
		}

		$query  = "SELECT * FROM terms WHERE terms.url = '$_url' $check_id LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT terms.*, (SELECT COUNT(*) FROM termusages WHERE termusages.term_id = terms.id) AS `count` FROM terms WHERE terms.id = $_id LIMIT 1 ";

		$result = \dash\pdo::get($query, [], null, true);

		return $result;
	}



	public static function get_all_tag()
	{
		$query = "SELECT terms.id, terms.title FROM terms ";

		$result = \dash\pdo::get($query);

		return $result;
	}




	public static function hot_tag()
	{
		$query =
		"
			SELECT
				terms.*
			FROM
				terms
			WHERE
				terms.id IN
				(
					SELECT termusages.term_id FROM termusages GROUP BY term_id ORDER BY COUNT(*) DESC
				)
			LIMIT 100
		";

		$result = \dash\pdo::get($query);

		return $result;
	}


}
?>