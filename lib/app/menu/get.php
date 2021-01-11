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

			if($parent1)
			{
				if($parent2)
				{
					if($parent3)
					{
						if($parent4)
						{
							if($parent5)
							{
								if(!isset($new_list[$parent1]['child'][$parent2]['child'][$parent3]['child'][$parent4]['child'][$parent5]))
								{
									$new_list[$parent1]['child'][$parent2]['child'][$parent3]['child'][$parent4]['child'][$parent5] = ['list' => []];
								}
								$new_list[$parent1]['child'][$parent2]['child'][$parent3]['child'][$parent4]['child'][$parent5]['list'][] = $value;
							}
							else
							{
								if(!isset($new_list[$parent1]['child'][$parent2]['child'][$parent3]['child'][$parent4]))
								{
									$new_list[$parent1]['child'][$parent2]['child'][$parent3]['child'][$parent4] = ['list' => [], 'child' => []];
								}
								$new_list[$parent1]['child'][$parent2]['child'][$parent3]['child'][$parent4]['list'][] = $value;

							}
						}
						else
						{
							if(!isset($new_list[$parent1]['child'][$parent2]['child'][$parent3]))
							{
								$new_list[$parent1]['child'][$parent2]['child'][$parent3] = ['list' => [], 'child' => []];
							}
							$new_list[$parent1]['child'][$parent2]['child'][$parent3]['list'][] = $value;

						}
					}
					else
					{
						if(!isset($new_list[$parent1]['child'][$parent2]))
						{
							$new_list[$parent1]['child'][$parent2] = ['list' => [], 'child' => []];
						}
						$new_list[$parent1]['child'][$parent2]['list'][] = $value;
					}
				}
				else
				{
					if(!isset($new_list[$parent1]))
					{
						$new_list[$parent1] = ['list' => [], 'child' =>[]];
					}
					$new_list[$parent1]['list'][] = $value;
				}
			}
		}

		return $new_list;
	}
}
?>