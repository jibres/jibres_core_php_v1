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


	// delete permission from project file
	public static function delete_permission($_id)
	{
		$id = \dash\validate::string($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid permission id"));
			return false;
		}

		$user_count = self::usercount();
		if(isset($user_count[$id]) && intval($user_count[$id]) > 0)
		{
			\dash\notif::error(T_("Someone have this permission!"). ' '. T_("Can not remove it."));
			return false;
		}

		if($id === 'admin')
		{
			\dash\notif::error(T_("Can not remove admin!"));
			return false;
		}


		$new = self::groups();

		if(!isset($new[$id]))
		{
			\dash\notif::error(T_("Permission not found"));
			return false;
		}

		unset($new[$id]);
		if(is_callable(['\lib\permission', 'delete_permission']))
		{
			$result = \lib\permission::delete_permission($new);
			if($result === null)
			{
				$new = json_encode($new, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				\dash\file::write(root.'/includes/permission/group.me.json', $new);
			}
		}
		else
		{
			$new = json_encode($new, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			\dash\file::write(root.'/includes/permission/group.me.json', $new);
		}

		\dash\log::set('permissionDelete', ['code' => $id]);
		\dash\notif::warn(T_("Permission removed"));
		return true;
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


	public static function list_raw_project()
	{
		return self::$project_perm_list;
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


	// save permission if file of every where
	public static function save_permission($_name, $_lable, $_contain, $_update = false)
	{

		if(!$_name)
		{
			\dash\notif::error(T_("Please set a valid name for permission"), 'name');
			return false;
		}

		$groups = self::groups();
		if(!$_update)
		{
			$_name = \dash\validate::slug($_name, false);

			if(array_key_exists($_name, $groups))
			{
				\dash\notif::error(T_("This key was reserved, Try another"), 'name');
				return false;
			}

			if(!$_lable)
			{
				$_lable = $_name;
			}

			if($_name === 'supervisor' || $_name === 'admin')
			{
				\dash\notif::error(T_("This key was reserved, Try another"), 'name');
				return false;
			}
		}
		else
		{
			if($_name === 'supervisor' || $_name === 'admin')
			{
				\dash\notif::warn(T_("Can not change admin permission"));
				return false;
			}

			if(!array_key_exists($_name, $groups))
			{
				\dash\notif::error(T_("This key was not found in your permission list!"), 'name');
				return false;
			}
		}

		if(is_numeric($_name))
		{
			\dash\notif::error(T_("The title must include at least one alphabetical character"), 'name');
			return false;
		}

		if(mb_strlen($_name) > 30)
		{
			\dash\notif::error(T_("Name too large, Try another"), 'name');
			return false;
		}


		if(mb_strlen($_lable) > 30)
		{
			\dash\notif::error(T_("Label too large, Try another"), 'label');
			return false;
		}

		if(!is_array($_contain))
		{
			\dash\notif::error(T_("Invalid contain of permission"));
			return false;
		}

		$all_list = self::lists();

		foreach ($_contain as $key => $value)
		{
			if(!array_key_exists($value, $all_list))
			{
				\dash\notif::error(T_("This item is not in your permission list!"));
				return false;
			}
		}

		// $new = self::$project_group;
		$new = self::groups();
		$new = array_merge($new, [$_name => ['title' => $_lable, 'contain' => $_contain]]);

		$saveInFile = false;

		if(is_callable(['\lib\permission', 'save_permission']))
		{
			$result = \lib\permission::save_permission($new);
			if($result === null)
			{
				$saveInFile = true;
			}
		}
		else
		{
			$saveInFile = true;
		}

		if($saveInFile)
		{
			$jsonMeAddr = root.'/includes/permission/group.me.json';
			$new = json_encode($new, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			\dash\file::write($jsonMeAddr, $new);
		}

		\dash\log::set('permissionAddNew', ['code' => $_name]);

		\dash\notif::ok(T_("Permission saved"));
		return true;
	}




	// opern permission for edit or delete
	public static function load_permission($_id)
	{

		if(array_key_exists($_id, self::$project_group))
		{
			return self::$project_group[$_id];
		}

		if(array_key_exists($_id, self::$core_group))
		{
			return self::$core_group[$_id];
		}

		return false;
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