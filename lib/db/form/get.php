<?php
namespace lib\db\form;


class get
{


	public static function sitemap_list($_from, $_to)
	{
		$query  =
		"
			SELECT
				form.id,
				form.slug,
				IFNULL(form.datemodified, form.datecreated) AS `datemodified`
			FROM
				form
			WHERE
				form.status = 'publish' AND
				form.id >= $_from AND
				form.id < $_to
		";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form WHERE form.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function show_table($_id)
	{
		$query = "SHOW TABLES LIKE 'form_view_table_$_id'";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>
