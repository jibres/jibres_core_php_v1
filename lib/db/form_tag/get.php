<?php
namespace lib\db\form_tag;


class get
{
	public static function all_tag($_id)
	{

		$query  = "SELECT form_tag.id, form_tag.title FROM form_tag WHERE form_tag.form_id = $_id ";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function mulit_title($_titles, $_form_id)
	{
		if(!is_array($_titles) || !$_titles)
		{
			return false;
		}

		$_titles = implode("','", $_titles);

		$query =
		"
			SELECT *
			FROM form_tag
			WHERE
				form_tag.form_id = $_form_id AND
				form_tag.title IN ('$_titles')
		";
		$result = \dash\db::get($query);

		return $result;
	}


	public static function one($_id)
	{
		$query  =
		"
			SELECT
				(SELECT COUNT(*) AS `count` FROM form_tagusage WHERE  form_tagusage.form_tag_id = form_tag.id) AS `count`,
				form_tag.*
			FROM
				form_tag
			WHERE
				form_tag.id = $_id
			LIMIT 1
		";


		$result = \dash\db::get($query, null, true);

		return $result;
	}



	public static function get_count_answer($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM form_tagusage WHERE  form_tagusage.form_tag_id = $_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function by_id($_id)
	{
		$query  = "SELECT * FROM form_tag WHERE form_tag.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_slug($_slug)
	{
		$query  = "SELECT * FROM form_tag WHERE form_tag.slug = '$_slug' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_all()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM form_tag ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function check_unique_slug($_slug, $_form_id)
	{
		$query  = "SELECT * FROM form_tag WHERE form_tag.slug = '$_slug' AND form_tag.form_id = $_form_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_duplicate($_slug, $_language)
	{
		$query  = "SELECT * FROM form_tag WHERE form_tag.slug = '$_slug' AND form_tag.language = '$_language' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function check_duplicate_title($_title, $_form_id)
	{
		$query  = "SELECT * FROM form_tag WHERE form_tag.title = '$_title' AND form_tag.form_id = $_form_id  LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
