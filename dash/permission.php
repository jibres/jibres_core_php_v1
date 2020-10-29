<?php
namespace dash;

/** Access: handle permissions **/
class permission
{
	// user permissio as a group name
	private static $user_permission         = null;

	// list of project permissin list
	private static $project_perm_list       = [];
	// list of project permission group
	private static $project_group           = [];
	// list of dash permission list
	private static $core_perm_list          = [];
	// list of dash permission group
	private static $core_group              = [];




	public static function who_have($_caller, $_admin = true)
	{
		if($_admin)
		{
			$perm_name = ['admin'];
		}
		else
		{
			$perm_name = [];
		}

		$group     = self::groups();
		foreach ($group as $key => $value)
		{
			if(isset($value['contain']) && is_array($value['contain']))
			{
				if(in_array($_caller, $value['contain']))
				{
					array_push($perm_name, $key);
				}
			}
		}
		return $perm_name;

	}




	// get count of user by permission group
	public static function usercount()
	{
		if(is_callable(['\lib\permission', 'usercount']))
		{
			$count = \lib\permission::usercount();
			if($count === null)
			{
				$count = \dash\db\users::permission_group();
			}
		}
		else
		{
			$count = \dash\db\users::permission_group();
		}

		$group = self::groups();

		$new_count = [];

		foreach ($group as $key => $value)
		{
			if(array_key_exists($key, $count))
			{
				$new_count[$key] = intval($count[$key]);
			}
			else
			{
				$new_count[$key] = 0;
			}
		}

		return $new_count;
	}


	// show all group name
	public static function groups($_project = false)
	{
		$all_group = [];

		$list = \dash\app\permission\get::list();

		if(!is_array($list))
		{
			$list = [];
		}

		$all_group = array_column($list, 'key');


		return $all_group;
	}


	// show all permission list
	public static function lists($_project = false)
	{

		$all_list = [];

		if($_project)
		{
			$all_list = self::$project_perm_list;
		}
		else
		{
			if(is_array(self::$core_perm_list) && is_array(self::$project_perm_list))
			{
				$all_list = array_merge(self::$core_perm_list, self::$project_perm_list);
			}
		}
		return $all_list;
	}




	// make an array to draw permission list in quick view
	public static function categorize_list()
	{
		$list     = \dash\plan::public_show_master_contain();

		$group    = \dash\plan::group_permission();

		$business = \dash\engine\store::inStore();

		$jibres   = !$business;

		$result   = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['group']))
			{
				$myJibres   = \dash\get::index($value, 'jibres');
				$myBusiness = \dash\get::index($value, 'business');

				// access to load permissin caller
				$access     = false;

				if($myJibres && !$myBusiness)
				{
					if($myJibres === $jibres)
					{
						$access = true;
					}
				}
				elseif(!$myJibres && $myBusiness)
				{
					if($myBusiness === $business)
					{
						$access = true;
					}
				}
				elseif($myJibres && $myBusiness)
				{
					$access = true;
				}


				if($access)
				{
					if(!isset($result[$value['group']]))
					{
						if(isset($group[$value['group']]))
						{
							$result[$value['group']] = $group[$value['group']];
						}
						else
						{
							$result[$value['group']] = ['title' => $value['group'], 'advance' => []];
						}
					}

					$result[$value['group']]['advance'][] = $value;
				}
			}
		}
		return $result;
	}







	// check the user is supervisor or not
	public static function supervisor()
	{

		$myPermission = \dash\user::detail('permission');


		if($myPermission === 'supervisor')
		{
			return true;
		}

		// the user is supervisor in jibres database
		if(\dash\user::jibres_user('permission') === 'supervisor')
		{
			return true;
		}

		return false;
	}




	// check permission
	public static function check($_caller)
	{
		// user is not login
		if(!\dash\user::id())
		{
			return false;
		}

		if(self::supervisor())
		{
			return true;
		}


		// we have store and need to check permission but the user not in this store
		if(\dash\engine\store::inStore())
		{
			if(!\lib\store::in_store())
			{
				return false;
			}
		}

		$check_plan = \dash\plan::check($_caller);
		// we have not this caller to this plan
		if($check_plan === false)
		{
			return false;
		}


		$myPermission = \dash\user::detail('permission');

		// user have not any permission
		if(!$myPermission)
		{
			return false;
		}

		// admin access to everything
		if($myPermission === 'admin' || $myPermission === 'supervisor')
		{
			return true;
		}

		$all_contain = self::groups();

		if(isset($all_contain[$myPermission]['contain']))
		{
			if(is_array($all_contain[$myPermission]['contain']) && in_array($_caller, $all_contain[$myPermission]['contain']))
			{
				return true;
			}
		}

		return false;
	}


	// check access
	public static function access($_caller, $_msg = null)
	{
		$check = self::check($_caller);

		if(!$check)
		{
			if(!$_msg)
			{
				$_msg = T_("Permission denied");
			}

			\dash\header::status(403, $_msg);
		}
		return true;
	}
}
?>