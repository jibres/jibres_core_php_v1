<?php
namespace lib\db\producttag;


class get
{

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


	public static function by_id($_id)
	{
		$query  = "SELECT * FROM producttag WHERE producttag.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_duplicate($_slug, $_language)
	{
		$query  = "SELECT * FROM producttag WHERE producttag.slug = '$_slug' AND producttag.language = '$_language' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
