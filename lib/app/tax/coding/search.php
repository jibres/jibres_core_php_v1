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

		$group = [];
		$total = [];
		$assistant = [];
		$details = [];


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


		// var_dump($group, $total, $assistant, $details);exit();
		$open_all = null;
		if(isset($_option['open_all']) && $_option['open_all'])
		{
			$open_all = ' class="jstree-open"';
		}

		$result = [];
		$html = '<div data-jstree class="font-12">';
		foreach ($group as $group_key => $group_value)
		{
			$html .= '<ul>';
			$html .= '<li class="jstree-open">'. $group_value['title'];

			$result[$group_key] = ['detail' => $group_value, 'list' => []];

			foreach ($total as $total_key => $total_value)
			{
				$check_total_key = $group_key . '_'. $total_value['id'];
				if($check_total_key === $total_key)
				{
					$html .= '<ul>';
					$html .= '<li'. $open_all. '>'. $total_value['title'];
					$result[$group_key]['list'][$total_key] = ['detail' => $total_value, 'list' => []];
					foreach ($assistant as $assistant_key => $assistant_value)
					{
						$check_assistant_key = $group_key . '_'. $total_value['id']. '_'. $assistant_value['id'];

						if($check_assistant_key === $assistant_key)
						{
							$html .= '<ul>';
							$html .= '<li'. $open_all.'>'. $assistant_value['title'];
							$result[$group_key]['list'][$total_key]['list'][$assistant_key] = ['detail' => $assistant_value, 'list' => []];
							foreach ($details as $details_key => $details_value)
							{
								$check_details_key = $group_key . '_'. $total_value['id']. '_'. $assistant_value['id']. '_'. $details_value['id'];
								if($check_details_key === $details_key)
								{
									$html .= '<ul>';
									$html .= '<li'. $open_all.'>'. $details_value['title'];
									$result[$group_key]['list'][$total_key]['list'][$assistant_key]['list'][$details_key] = ['detail' => $details_value];
									$html .= '</li>';
									$html .= '</ul>';
								}
							}
							$html .= '</li>';
							$html .= '</ul>';
						}
					}
					$html .= '</li>';
					$html .= '</ul>';
				}
			}

			$html .= '</li>';
			$html .= '</ul>';
		}
		$html .= '</div>';

		// var_dump($result);exit();
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

}
?>