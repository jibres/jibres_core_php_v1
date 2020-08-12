<?php
namespace lib\app\tax\coding;


class search
{

	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;


	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}



	public static function list_tree($_option = [])
	{
		$list_tree = \lib\db\tax_coding\get::list_tree();
		if(!is_array($list_tree))
		{
			$list_tree = [];
		}

		$list_tree = array_map(['\\lib\\app\\tax\\coding\\ready', 'row'], $list_tree);

		$group     = [];
		$total     = [];
		$assistant = [];
		$details   = [];





		$view_id = null;
		if(isset($_option['view_id']) && $_option['view_id'])
		{
			$view_id = $_option['view_id'];
		}


		foreach ($list_tree as $key => $value)
		{
			if(!\dash\get::index($value, 'parent1') && !\dash\get::index($value, 'parent2') && !\dash\get::index($value, 'parent3'))
			{
				if(!isset($group[$value['id']]))
				{
					$group[$value['id']] = $value;
				}
			}

			if(\dash\get::index($value, 'parent1') && !\dash\get::index($value, 'parent2') && !\dash\get::index($value, 'parent3'))
			{
				if(!isset($total[$value['parent1']. '_'. $value['id']]))
				{
					$total[$value['parent1']. '_'. $value['id']] = $value;
				}
			}

			if(\dash\get::index($value, 'parent1') && \dash\get::index($value, 'parent2') && !\dash\get::index($value, 'parent3'))
			{
				if(!isset($assistant[$value['parent1']. '_'. $value['parent2']. '_'. $value['id']]))
				{
					$assistant[$value['parent1']. '_'. $value['parent2']. '_'. $value['id']] = $value;
				}
			}

			if(\dash\get::index($value, 'parent1') && \dash\get::index($value, 'parent2') && \dash\get::index($value, 'parent3'))
			{
				if(!isset($details[$value['parent1']. '_'. $value['parent2']. '_'. $value['parent3']. '_'. $value['id']]))
				{
					$details[$value['parent1']. '_'. $value['parent2']. '_'. $value['parent3']. '_'. $value['id']] = $value;
				}
			}
		}

		$view_id_detail              = [];
		$view_id_detail['group']     = null;
		$view_id_detail['total']     = null;
		$view_id_detail['assistant'] = null;
		$view_id_detail['details']   = null;

		$open_all = null;
		if(isset($_option['open_all']) && $_option['open_all'])
		{
			$open_all = ' class="jstree-open"';
		}

		if($view_id)
		{
			$load = \lib\app\tax\coding\get::get($view_id);

			if(\dash\get::index($load, 'parent1') && \dash\get::index($load, 'parent2') && \dash\get::index($load, 'parent3'))
			{
				$view_id_detail['group']     = $load['parent1'];
				$view_id_detail['total']     = $load['parent2'];
				$view_id_detail['assistant'] = $load['parent3'];
				$view_id_detail['details']   = $load['id'];
			}
			elseif(\dash\get::index($load, 'parent1') && \dash\get::index($load, 'parent2') && !\dash\get::index($load, 'parent3'))
			{
				$view_id_detail['group']     = $load['parent1'];
				$view_id_detail['total']     = $load['parent2'];
				$view_id_detail['assistant'] = $load['id'];
			}
			elseif(\dash\get::index($load, 'parent1') && !\dash\get::index($load, 'parent2') && !\dash\get::index($load, 'parent3'))
			{
				$view_id_detail['group']     = $load['parent1'];
				$view_id_detail['total']     = $load['id'];
			}
			elseif(!\dash\get::index($load, 'parent1') && !\dash\get::index($load, 'parent2') && !\dash\get::index($load, 'parent3'))
			{
				$view_id_detail['group']     = $load['id'];
			}

			$view_id_detail['type'] = $load['type'];

		}



		$result = [];
		$html = '<div data-jstree class="font-12">';
		foreach ($group as $group_key => $group_value)
		{
			$html .= '<ul>';
			$html .= '<li '. self::checkOpen($open_all, $group_value, $view_id_detail, 'group') .'">'. self::htmltTitleJsTree($group_value);

			$result[$group_key] = ['detail' => $group_value, 'list' => []];

			foreach ($total as $total_key => $total_value)
			{
				$check_total_key = $group_key . '_'. $total_value['id'];
				if($check_total_key === $total_key)
				{
					$html .= '<ul>';
					$html .= '<li'. self::checkOpen($open_all, $total_value, $view_id_detail, 'total') . '>'. self::htmltTitleJsTree($total_value);
					$result[$group_key]['list'][$total_key] = ['detail' => $total_value, 'list' => []];
					foreach ($assistant as $assistant_key => $assistant_value)
					{
						$check_assistant_key = $group_key . '_'. $total_value['id']. '_'. $assistant_value['id'];

						if($check_assistant_key === $assistant_key)
						{
							$html .= '<ul>';
							$html .= '<li'. self::checkOpen($open_all, $assistant_value, $view_id_detail, 'assistant') .'>'. self::htmltTitleJsTree($assistant_value);
							$result[$group_key]['list'][$total_key]['list'][$assistant_key] = ['detail' => $assistant_value, 'list' => []];
							foreach ($details as $details_key => $details_value)
							{
								$check_details_key = $group_key . '_'. $total_value['id']. '_'. $assistant_value['id']. '_'. $details_value['id'];
								if($check_details_key === $details_key)
								{
									$html .= '<ul>';
									$html .= '<li'. self::checkOpen($open_all, $details_value, $view_id_detail, 'details') .'>'. self::htmltTitleJsTree($details_value);
									$result[$group_key]['list'][$total_key]['list'][$assistant_key]['list'][$details_key] = ['detail' => $details_value];
									$html .= '</li>'. "\n";
									$html .= '</ul>';
								}
							}
							$html .= '</li>'. "\n";
							$html .= '</ul>';
						}
					}
					$html .= '</li>'. "\n";
					$html .= '</ul>';
				}
			}

			$html .= '</li>'. "\n";
			$html .= '</ul>';
		}
		$html .= '</div>';

		// var_dump($html);exit();
		// var_dump($result);exit();
		return $html;
	}


	private static function checkOpen($open_all, $_data, $view_id_detail, $type)
	{
		$jsTree = [];

		if($open_all)
		{
			$jsTree["opened"] = true;
		}

		if($type === 'group')
		{
			$jsTree['icon'] = "sf-asterisk fc-red";
		}

		if($type === 'total')
		{
			$jsTree['icon'] = "sf-thumbnails fs14 fc-blue";
		}



		if($type === 'group')
		{
			if(isset($view_id_detail['group']))
			{
				if(intval($_data['id']) === intval($view_id_detail['group']) && \dash\get::index($view_id_detail, 'type') === $type)
				{
					$jsTree['selected'] = true;
					$jsTree['opened'] = true;
				}
			}
		}

		if($type === 'total')
		{
			if(isset($view_id_detail['group']) && isset($view_id_detail['total']))
			{
				if(intval($_data['id']) === intval($view_id_detail['group']))
				{
					$jsTree["opened"] = true;
				}

				if(intval($_data['id']) === intval($view_id_detail['total'])  && \dash\get::index($view_id_detail, 'type') === $type)
				{
					$jsTree['selected'] = true;
					$jsTree['opened'] = true;
				}
			}
		}

		if($type === 'assistant')
		{
			if(isset($view_id_detail['group']) && isset($view_id_detail['total']) && isset($view_id_detail['assistant']))
			{
				if(intval($_data['id']) === intval($view_id_detail['group']))
				{
					$jsTree["opened"] = true;
				}

				if(intval($_data['id']) === intval($view_id_detail['total']))
				{
					$jsTree["opened"] = true;
				}

				if(intval($_data['id']) === intval($view_id_detail['assistant']) && \dash\get::index($view_id_detail, 'type') === $type)
				{
					$jsTree['selected'] = true;
					$jsTree['opened'] = true;
				}
			}
		}

		if($type === 'details')
		{
			if(isset($view_id_detail['group']) && isset($view_id_detail['total']) && isset($view_id_detail['assistant']) && isset($view_id_detail['details']))
			{
				if(intval($_data['id']) === intval($view_id_detail['group']))
				{
					$jsTree["opened"] = true;
				}

				if(intval($_data['id']) === intval($view_id_detail['total']))
				{
					$jsTree["opened"] = true;
				}

				if(intval($_data['id']) === intval($view_id_detail['assistant']))
				{
					$jsTree["opened"] = true;
				}

				if(intval($_data['id']) === intval($view_id_detail['details']))
				{
					$jsTree['selected'] = true;
					$jsTree['opened'] = true;
				}
			}
		}


		$result = " data-jstree='". json_encode($jsTree). "' ";
		return $result;

	}


	private static function htmltTitleJsTree($_data)
	{
		$html = '';
		$parent = null;
		if(isset($_data['parent3']) && $_data['parent3'])
		{
			$parent = $_data['parent3'];
		}
		elseif(isset($_data['parent2']) && $_data['parent2'])
		{
			$parent = $_data['parent2'];
		}
		elseif(isset($_data['parent1']) && $_data['parent1'])
		{
			$parent = $_data['parent1'];
		}

		if($parent)
		{
			$parent = '&parent='. $parent;
		}

		$html .= '<a href="'. \dash\url::that(). '/edit?id='. $_data['id']. $parent. '">';
		$html .= '<code>'. $_data['code']. '</code> '. $_data['title'];

		if(isset($_data['nature']))
		{
			$html .= ' ('.T_(ucfirst($_data['nature'])).') ';
		}
		if(isset($_data['detailable']))
		{
			$html .= ' ('.T_("Detailable").') ';
		}

		if(isset($_data['status']) && $_data['status'] === 'disable')
		{
			$html .= ' ('.T_("Disable").') ';
		}

		$html .= '</a>';

		return $html;
	}


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'   => 'order',
			'sort'    => ['enum' => ['title', 'code']],
			'type'    => ['enum' => ['assistant', 'group', 'total', 'details']],
			'user_id' => 'code',
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;
		// $meta['pagination'] = false;

		$order_sort  = null;


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);

		if($query_string)
		{
			$or[] = " tax_coding.title LIKE '%$query_string%' ";
			self::$is_filtered = true;
		}

		if($data['type'])
		{
			$and[] = " tax_coding.type = '$data[type]' ";
			self::$is_filtered = true;
		}

		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['datecreated']))
			{
				$sort = mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY tax_coding.code ASC";
		}

		$list = \lib\db\tax_coding\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\tax\\coding\\ready', 'row'], $list);

		$filter_args_data = [];

		foreach (self::$filter_args as $key => $value)
		{
			if(isset($list[0][$key]) && substr($value, 0, 1) === '*')
			{
				$filter_args_data[substr($value, 1)] = $list[0][$key];
			}
			else
			{
				$filter_args_data[$key] = $value;
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
	}


	public static function list_sort()
	{
		$list = self::list(...func_get_args());

		if(!is_array($list))
		{
			$list = [];
		}

		foreach ($list as $key => $value)
		{
			$sort_key = '';
			if(\dash\get::index($value, 'parent1'))
			{
				$sort_key .= \dash\get::index($value, 'parent1'). '_';
			}

			if(\dash\get::index($value, 'parent2'))
			{
				$sort_key .= \dash\get::index($value, 'parent2'). '_';
			}

			if(\dash\get::index($value, 'parent3'))
			{
				$sort_key .= \dash\get::index($value, 'parent3'). '_';
			}

			if(\dash\get::index($value, 'id'))
			{
				$sort_key .= \dash\get::index($value, 'id');
			}


			$list[$key]['sort_key'] = $sort_key;
		}

		$sort_column = array_column($list, 'sort_key');


		// if(count($sort_column) === count($list))
		// {
		// 	$my_sorted_list = $list;

		// 	array_multisort($my_sorted_list, SORT_DESC, $sort_column);

		// 	$list = $my_sorted_list;
		// }

		return $list;

	}

}
?>