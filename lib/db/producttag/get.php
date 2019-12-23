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
}
?>
