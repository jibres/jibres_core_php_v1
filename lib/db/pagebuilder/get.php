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


	public static function header_exists(string $_related)
	{
		$query  = "SELECT * FROM pagebuilder WHERE pagebuilder.related = '$_related' AND pagebuilder.mode = 'header'  LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}




	public static function line_list(string $_related)
	{
		$query  =
		"
			SELECT
				*
			FROM
				pagebuilder
			WHERE
				pagebuilder.related = '$_related'
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
