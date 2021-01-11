<?php
namespace lib\app\menu;


class edit
{
	public static function edit($_args, $_id)
	{
		\dash\permission::access('_group_setting');

		$load = \lib\app\menu\get::get($_id);
		if(!$load)
		{
			return false;
		}


		$args = \lib\app\menu\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$exception = [];
		if(isset($_args['parent']))
		{
			$exception[] = 'parent1';
			$exception[] = 'parent2';
			$exception[] = 'parent3';
			$exception[] = 'parent4';
			$exception[] = 'parent5';
		}

		if(isset($args['product_id']) || isset($args['post_id']) || isset($args['tag_id']) || isset($args['hashtag_id']))
		{
			$exception[] = 'related_id';
		}

		if(isset($args['socialnetwork']))
		{
			$exception[] = 'url';
		}


		$args = \dash\cleanse::patch_mode($_args, $args, $exception);

		if(empty($args))
		{
			\dash\notif::info(T_("No data to change"));
			return false;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\menu\update::update($args, $_id);

		\dash\notif::ok(T_("Menu updated"));

		return true;
	}



	private static $sort_level = [];

	public static function sort($_args, $_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Id is required"));
			return false;
		}

		if(!is_array($_args))
		{
			\dash\notif::error(T_("Sort arguments must be array"));
			return false;
		}

		$args = array_values($_args);

		$update = [];

		foreach ($args as $sort_number => $string)
		{
			$split  = explode('-', $string);

			$my_sort = $sort_number + 1;

			if(count($split) === 0)
			{
				return false;
			}
			elseif(count($split) === 1)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$update[$level1['id']] = ['parent1' => $id, 'sort' => $my_sort];
			}
			elseif(count($split) === 2)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$level2 = self::get_level_id($split[1]);
				if(!$level2)
				{
					return false;
				}

				$update[$level2['id']] = ['parent1' => $id, 'parent2' => $level1['id'], 'sort' => $my_sort];
			}
			elseif(count($split) === 3)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$level2 = self::get_level_id($split[1]);
				if(!$level2)
				{
					return false;
				}

				$level3 = self::get_level_id($split[2]);
				if(!$level3)
				{
					return false;
				}

				$update[$level3['id']] = ['parent1' => $id, 'parent2' => $level1['id'], 'parent3' => $level2['id'], 'sort' => $my_sort];

			}
			elseif(count($split) === 4)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$level2 = self::get_level_id($split[1]);
				if(!$level2)
				{
					return false;
				}

				$level3 = self::get_level_id($split[2]);
				if(!$level3)
				{
					return false;
				}

				$level4 = self::get_level_id($split[3]);
				if(!$level4)
				{
					return false;
				}

				$update[$level4['id']] = ['parent1' => $id, 'parent2' => $level1['id'], 'parent3' => $level2['id'], 'parent4' => $level3['id'], 'sort' => $my_sort];

			}
			elseif(count($split) === 5)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$level2 = self::get_level_id($split[1]);
				if(!$level2)
				{
					return false;
				}

				$level3 = self::get_level_id($split[2]);
				if(!$level3)
				{
					return false;
				}

				$level4 = self::get_level_id($split[3]);
				if(!$level4)
				{
					return false;
				}

				$level5 = self::get_level_id($split[4]);
				if(!$level5)
				{
					return false;
				}

				$update[$level5['id']] = ['parent1' => $id, 'parent2' => $level1['id'], 'parent3' => $level2['id'], 'parent4' => $level3['id'], 'parent5' => $level4['id'], 'sort' => $my_sort];
			}
		}

		if(!empty($update))
		{
			\lib\db\menu\update::sort_level($update);
		}

	}


	private static function get_level_id($_string)
	{
		$split_level = explode('_', $_string);

		$level       = null;
		$id          = null;

		if(isset($split_level[0]))
		{
			$level = \dash\validate::tinyint($split_level[0]);

			if(!isset($level))
			{
				return false;
			}

			$level = intval($level) + 1;

			if(!in_array($level, [1,2,3,4,5]))
			{
				$level = null;
			}
		}

		if(isset($split_level[1]))
		{
			$id = \dash\validate::id($split_level[1]);
			if(!$id)
			{
				return false;
			}
		}

		$result          = [];
		$result['id']    = $id;
		$result['level'] = $level;

		return $result;
	}

}
?>