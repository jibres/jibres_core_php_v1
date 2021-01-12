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



	public static function child($_id)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$list = \lib\db\menu\get::child($id);
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