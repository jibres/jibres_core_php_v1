<?php
namespace lib\pagebuilder\tools;


class search
{


	public static function list($_args = [])
	{
		$list = [];
		$id = \dash\request::get('id');
		$id = \dash\validate::code($id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			return false;
		}

		$list = \lib\db\pagebuilder\get::line_list($id);

		return $list;
	}

}
?>