<?php
namespace lib\app\plugin;


class search
{
	public static function list($_query_string, $_args)
	{
		$condition =
		[
			'category'      => 'string_100',

		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


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
				if(strpos(a($value, 'title'), $query_string) !== false)
				{
					$new_list[] = $value;
					continue;
				}

				if(strpos(a($value, 'description'), $query_string) !== false)
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
}
?>