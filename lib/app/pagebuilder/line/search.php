<?php
namespace lib\app\pagebuilder\line;


class search
{


	public static function list($_args = [])
	{
		$list = [];

		$list = \lib\db\pagebuilder\get::by_related('homepage');

		return $list;
	}

}
?>