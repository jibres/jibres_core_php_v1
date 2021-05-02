<?php
namespace lib\db\pagebuilder;


class get
{

	public static function by_id(int $_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function header_footer_exists($_related_id, string $_mode)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = '$_related_id' AND pagebuilder.mode = '$_mode'  LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function homepage_header_footer($_related_id)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = '$_related_id' AND pagebuilder.mode IN ('header', 'footer') ";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function line_list(int $_id)
	{
		$query  =
		"
			SELECT
				*
			FROM
				pagebuilder
			WHERE
				pagebuilder.related_id = $_id
			ORDER BY
				FIELD(pagebuilder.mode, 'header', 'body', 'footer'),
				pagebuilder.sort ASC,
				pagebuilder.id ASC
			LIMIT 1000
		";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function count_by_type(string $_type)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM pagebuilder WHERE pagebuilder.type = '$_type' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function last_sort($_args)
	{
		$where  = \dash\db\config::make_where($_args);
		$query  = "SELECT pagebuilder.sort AS `sort` FROM pagebuilder WHERE $where ORDER BY pagebuilder.sort DESC, pagebuilder.id DESC LIMIT 1";
		$result = \dash\db::get($query, 'sort', true);
		return $result;
	}
}
?>
