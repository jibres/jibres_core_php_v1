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

		$post_detail = \lib\pagebuilder\tools\get::load_post_detail($id);

		$list = \lib\db\pagebuilder\get::line_list($id);

		$result = [];
		$result['post_detail'] = $post_detail;
		$result['list'] = $list;
		return $result;
	}

}
?>