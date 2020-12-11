<?php
namespace dash\db\termusages;


class get
{


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
				terms.slug
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
