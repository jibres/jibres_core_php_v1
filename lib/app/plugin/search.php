<?php
namespace lib\app\plugin;


class search
{
	public static function list($_query_string, $_args)
	{
		$list = \lib\app\plugin\get::all_list();


		return $list;

	}
}
?>