<?php
namespace lib;

class permission
{
	// all plan list
	private static $plan = [];


	public static function plan_setting($_key = null, $_plan = null)
	{
		self::load_all_plans();

		if(array_key_exists($_plan, self::$plan))
		{
			$my_plan = self::$plan[$_plan];
			if(!$_key)
			{
				return $my_plan;
			}
			else
			{
				if(array_key_exists($_key, $my_plan))
				{
					return $my_plan[$_key];
				}
				return null;
			}
		}

		return false;
	}


	// load user in user
	public static function load_user($_user_id = null, $_force = false)
	{
		if(!\lib\store::loaded())
		{
			return null;
		}
	}


	// get user count group by permission
	public static function usercount()
	{
		if(!\lib\store::loaded())
		{
			return null;
		}

		$count = \dash\db\users::permission_group();
		return $count;
	}


	// delete permission
	public static function delete_permission($_new_permission_array)
	{
		return self::save_permission($_new_permission_array);
	}


	// get list of permission by check plan
	public static function perm_list($_master_contain, $_postion)
	{
		if(!\lib\store::loaded())
		{
			return $_master_contain;
		}

		self::load_all_plans();

		$new_contain = [];

		if(!is_array($_master_contain))
		{
			return $new_contain;
		}

		foreach ($_master_contain as $key => $value)
		{
			if(self::plan($key))
			{
				$new_contain[$key] = $value;
			}
		}

		return $new_contain;
	}


	// save permission in store permission
	public static function save_permission($_new_permission_array)
	{
		if(\lib\store::id())
		{
			$_new_permission_array = json_encode($_new_permission_array, JSON_UNESCAPED_UNICODE);
			\lib\db\stores::update(['permission' => $_new_permission_array], \lib\store::id());
			\lib\store::refresh();
			return true;
		}

		return null;
	}


	// get permisison group list from store permission field
	public static function group_list($_master_groups, $_postion)
	{
		if(!\lib\store::loaded())
		{
			return $_master_groups;
		}

		$all_group = $store_group = self::store_group();

		if(!$store_group)
		{
			$jibres_group     = \dash\permission::read_file(root.'/includes/permission/group.json');

			if(is_array($jibres_group) && is_array($store_group))
			{
				$all_group = array_merge($jibres_group, $store_group);
			}
		}

		return $all_group;
	}


	// laod all plan list by read file
	private static function load_all_plans()
	{
		if(empty(self::$plan))
		{
			$plan_file = root.'/includes/permission/plan.php';
			if(is_file($plan_file))
			{
				include_once($plan_file);
			}
		}
	}


	// check the caller is exist in plan
	public static function plan($_caller)
	{
		if(!\lib\store::loaded())
		{
			return null;
		}

		self::load_all_plans();
		$store_plan = \lib\store::plan();

		if(isset(self::$plan[$store_plan]) && isset(self::$plan[$store_plan]['contain']))
		{
			if(is_array(self::$plan[$store_plan]['contain']) && in_array($_caller, self::$plan[$store_plan]['contain']))
			{
				return true;
			}
		}

		return false;
	}


	// check permission by check users permission field
	public static function check($_caller)
	{
		if(!\lib\store::loaded())
		{
			return null;
		}

		$user_permission = \dash\user::detail('permission');

		if($user_permission === 'admin')
		{
			return true;
		}

		$store_permission_group = self::store_group();

		if(isset($store_permission_group[$user_permission]['contain']))
		{
			if(is_array($store_permission_group[$user_permission]['contain']) && in_array($_caller, $store_permission_group[$user_permission]['contain']))
			{
				return true;
			}
		}

		return false;
	}


	// get permission group saved in permission field of store
	private static function store_group()
	{
		$store_group = \lib\store::detail('permission');

		if(is_string($store_group) && substr($store_group, 0, 1) === '{')
		{
			$store_group = json_decode($store_group, true);
		}

		if(!is_array($store_group))
		{
			$store_group = [];
		}

		return $store_group;
	}
}
?>
