<?php
namespace lib\db\form;


class get
{

	public static function by_multi_id($_ids)
	{
		$query = "SELECT * FROM form WHERE form.id IN ($_ids)";
		$result = \dash\pdo::get($query);
		return $result;

	}

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
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "SELECT * FROM form WHERE form.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function load_public_form($_slug_or_id)
	{
		if(is_numeric($_slug_or_id))
		{
			$query = "SELECT * FROM form WHERE form.slug = :slug OR form.id = :id LIMIT 1";
			$param = [':slug' => $_slug_or_id, ':id' => $_slug_or_id];
		}
	else
		{
			$_slug_or_id = \dash\validate::slug($_slug_or_id, false);
			if(!$_slug_or_id)
			{
				return false;
			}
			$query = "SELECT * FROM form WHERE form.slug = :slug  LIMIT 1";
			$param = [':slug' => $_slug_or_id];
		}


		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function by_slug($_slug)
	{
		$query = "SELECT * FROM form WHERE form.slug = :slug  LIMIT 1";
		$param = [':slug' => $_slug];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function show_table($_id)
	{
		$query = "SHOW TABLES LIKE 'form_view_table_$_id'";
		$result = \dash\pdo::get($query);
		return $result;
	}
}
?>
