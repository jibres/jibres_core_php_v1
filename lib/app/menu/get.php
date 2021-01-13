<?php
namespace lib\app\menu;


class get
{


	public static function get($_id)
	{
		\dash\permission::access('_group_setting');

		return self::public_get($_id);

	}


	public static function list_all_menu()
	{
		$list = \lib\db\menu\get::list_all_menu();
		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\menu\\ready', 'row'], $list);

		return $list;
	}



	public static function public_get($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\menu\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\menu\ready::row($load);

		return $load;
	}


	public static function child_count($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$count = \lib\db\menu\get::child_count($id);

		$count = intval($count);

		return $count;
	}



	public static function one_child($_master_id, $_id)
	{
		$master_id = \dash\validate::id($_master_id);
		$id        = \dash\validate::id($_id);

		if(!$master_id || !$id)
		{
			return false;
		}

		$load = \lib\db\menu\get::child_by_master_id($master_id, $id);

		if(!$load)
		{
			\dash\notif::error(T_("Data not found"));
			return false;
		}

		$load = \lib\app\menu\ready::row($load);

		return $load;
	}


	public static function get_master($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\menu\get::master_by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Data not found"));
			return false;
		}

		$load = \lib\app\menu\ready::row($load);

		return $load;
	}



	public static function load_menu($_id, $_max_level = 1)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		if(!$_max_level || !in_array($_max_level, [1, 2, 3, 4, 5]))
		{
			$_max_level = 1;
		}

		$_max_level = 5;

		$load = \lib\db\menu\get::load_menu($id, $_max_level);

		if(!$load || !is_array($load))
		{
			return null;
		}

		$post_id    = [];
		$product_id = [];
		$tag_id     = [];
		$hashtag_id = [];
		$form_id    = [];
		$social     = [];

		$result =
		[
			'title' => null,
			'list' => [],
		];

		foreach ($load as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');
			$parent5 = a($value, 'parent5');

			if(!$parent1 && !$parent2 && !$parent3 && !$parent4 && !$parent5)
			{
				$result['title'] = a($value, 'title');
				continue;
			}

			$result['list'][] = $value;
		}

		$result['list'] = self::make_menu($result['list']);

		return $result;

	}



	public static function child($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$list = \lib\db\menu\get::child($id);
		\dash\temp::set('calcMenuChildCount', count($list));


		return self::make_menu($list);

	}


	private  static function make_menu($list)
	{

		if(!is_array($list))
		{
			$list = [];
		}



		$list = array_map(['\\lib\\app\\menu\\ready', 'row'], $list);

		$list = array_combine(array_column($list, 'id'), $list);

		$new_list = [];

		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');
			$parent5 = a($value, 'parent5');

			if($parent1 && !$parent2 && !$parent3 && !$parent4 && !$parent5)
			{
				$new_list[$key] = $value;
			}
		}


		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');
			$parent5 = a($value, 'parent5');

			if($parent1 && $parent2 && !$parent3 && !$parent4 && !$parent5)
			{
				$new_list[$parent2]['child'][$key] = $value;
			}
		}


		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');
			$parent5 = a($value, 'parent5');

			if($parent1 && $parent2 && $parent3 && !$parent4 && !$parent5)
			{
				$new_list[$parent2]['child'][$parent3]['child'][$key] = $value;
			}

		}

		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');
			$parent5 = a($value, 'parent5');

			if($parent1 && $parent2 && $parent3 && $parent4 && !$parent5)
			{
				$new_list[$parent2]['child'][$parent3]['child'][$parent4]['child'][$key] = $value;
			}
		}


		foreach ($list as $key => $value)
		{
			$parent1 = a($value, 'parent1');
			$parent2 = a($value, 'parent2');
			$parent3 = a($value, 'parent3');
			$parent4 = a($value, 'parent4');
			$parent5 = a($value, 'parent5');

			if($parent1 && $parent2 && $parent3 && $parent4 && $parent5)
			{
				$new_list[$parent2]['child'][$parent3]['child'][$parent4]['child'][$parent5]['child'][$key] = $value;
			}
		}

		return $new_list;
	}
}
?>