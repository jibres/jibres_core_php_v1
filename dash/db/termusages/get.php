<?php
namespace dash\db\termusages;


class get
{

	public static function get_count_all()
	{
		$query = "SELECT COUNT(*) AS `termusages` ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function first_category_url($_post_id)
	{
		$query =
		"
			SELECT
				terms.url AS `url`
			FROM
				termusages
			INNER JOIN terms ON terms.id = termusages.term_id
			WHERE
				termusages.post_id = $_post_id AND
				termusages.type = 'cat'
			ORDER BY termusages.id ASC
			LIMIT 1
		";

		$result = \dash\db::get($query, 'url', true);

		return $result;
	}


	public static function usage($_post_id, $_type)
	{
		if(!$_post_id || !$_type)
		{
			return false;
		}

		$query =
		"
			SELECT
				terms.id AS `term_id`,
				terms.title,
				terms.url
			FROM
				termusages
			INNER JOIN terms ON terms.id = termusages.term_id
			WHERE
				termusages.post_id = $_post_id AND
				termusages.type = '$_type'
		";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>
