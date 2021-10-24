<?php
namespace lib\app\premium;


class search
{
	public static function list($_query_string, $_args)
	{
		$list = \lib\app\premium\get::all_list();


		return $list;

	}
}
?>