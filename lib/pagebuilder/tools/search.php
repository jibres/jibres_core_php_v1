<?php
namespace lib\pagebuilder\tools;


class search
{


	public static function list($_args = [])
	{
		$list = [];

		$list = \lib\db\pagebuilder\get::line_list('homepage');

		return $list;
	}

}
?>