<?php
namespace content_v2\category;


class datalist
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			$result = self::list();
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	public static function route_child($_category_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::list_child($_category_id);
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}

	private static function list_child($_category_id)
	{
		$list = \lib\app\category\search::list_child($_category_id, \dash\request::get('q'));

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['self', 'ready'], $list);
		return $list;
	}


	private static function list()
	{
		$meta = [];
		$meta['parent1'] = null;
		$meta['parent2'] = null;
		$meta['parent3'] = null;

		$list = \lib\app\category\search::list(\dash\request::get('q'), $meta);

		if(!is_array($list))
		{
			$list = [];
		}


		$list = array_map(['self', 'ready'], $list);
		return $list;
	}


	private static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'title':
				case 'slug':
				case 'language':
				case 'desc':
				case 'seotitle':
				case 'seodesc':
				case 'file':
				case 'count':
				case 'parent_slug':
				case 'parent_title':
				case 'full_slug':
				case 'full_title':
				case 'have_child':
				case 'have_product':
					$result[$key] = $value;
					break;

				default:
					// nothing
					break;
			}
		}

		return $result;
	}
}
?>