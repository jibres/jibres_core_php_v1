<?php
namespace lib\app\plugin;


class search
{
	public static function list($_query_string, $_args)
	{
		$condition =
		[
			'category'   => 'string_100',
			'activated'  => 'bit',
			'sync'       => 'bit',
			'admin_list' => 'bit',

		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		// force sync plugin by jibres
		if($data['sync'] && !$data['admin_list'])
		{
			\lib\app\plugin\business::sync_required();
		}

		$list = \lib\app\plugin\get::all_list();


		if($data['category'])
		{
			$new_list = [];

			foreach ($list as $key => $value)
			{
				if(is_array(a($value, 'keywords')) &&  in_array($data['category'], $value['keywords']))
				{
					$new_list[] = $value;
					continue;
				}
			}

			$list = $new_list;
		}


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$new_list = [];
			foreach ($list as $key => $value)
			{
				if(\dash\str::strpos(a($value, 'title'), $query_string) !== false)
				{
					$new_list[] = $value;
					continue;
				}

				if(\dash\str::strpos(a($value, 'description'), $query_string) !== false)
				{
					$new_list[] = $value;
					continue;
				}

				if(is_array(a($value, 'keywords')) &&  in_array($query_string, $value['keywords']))
				{
					$new_list[] = $value;
					continue;
				}
			}

			$list = $new_list;

		}

		if($data['activated'] && !$data['admin_list'])
		{
			$new_list = [];

			foreach ($list as $key => $value)
			{
				$new_list[] = $value;
			}

			$list = $new_list;
		}



		$all_keywords = [];

		foreach ($list as $key => $value)
		{
			if(is_array(a($value, 'keywords')))
			{
				$all_keywords = array_merge($value['keywords'], $all_keywords);
			}
		}

		$all_keywords = array_filter($all_keywords);
		$all_keywords = array_unique($all_keywords);


		$result             = [];
		$result['list']     = $list;
		$result['keywords'] = $all_keywords;

		return $result;
	}


	public static function all_list_by_count()
	{
		$list         = self::all_list();
		$count_all    = \lib\db\store_plugin\get::group_by_plugin();
		$count_enable = \lib\db\store_plugin\get::group_by_plugin_status('enable');

		foreach ($list as $key => $value)
		{
			if(isset($value['plugin']))
			{
				if(isset($count_all[$value['plugin']]))
				{
					$list[$key]['count_use'] = $count_all[$value['plugin']];
				}

				if(isset($count_enable[$value['plugin']]))
				{
					$list[$key]['count_enable'] = $count_enable[$value['plugin']];
				}
			}
		}

		return $list;

	}
}
?>