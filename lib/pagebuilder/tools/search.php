<?php
namespace lib\pagebuilder\tools;


class search
{


	public static function list($_args = [])
	{
		if(isset($_args['id']))
		{
			$id = $_args['id'];
		}
		else
		{
			$id = \dash\request::get('id');
		}

		$id = \dash\validate::code($id);

		$id = \dash\coding::decode($id);

		if(!$id)
		{
			return false;
		}

		$post_detail = \lib\pagebuilder\tools\get::load_post_detail($id);

		$list = \lib\db\pagebuilder\get::line_list($id);

		$result                = [];

		$result['post_detail'] = $post_detail;

		if(isset($_args['ready']) && $_args['ready'])
		{
			self::ready($result, $list);
		}
		else
		{
			$result['list']        = $list;
		}


		return $result;
	}


	private static function ready(&$result, $list)
	{
		$result['header'] = [];
		$result['body']   = [];
		$result['footer'] = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['mode']) && isset($value['type']) && is_string($value['type']))
			{
				if(in_array($value['mode'], ['header', 'footer', 'body']))
				{
					$result[$value['mode']][] = \lib\pagebuilder\tools\tools::global_ready_show($value['mode'], $value['type'], $value);
				}
			}
		}
	}

}
?>