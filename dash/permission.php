<?php
namespace dash;

/** Access: handle permissions **/
class permission
{

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

		return false;
	}


	/**
	 * Determines user have any permission or no
	 *
	 * @return     boolean  True if permission, False otherwise.
	 */
	public static function has_permission()
	{
		return self::check(null, ['only_check_has_permission' => true]);
	}


	/**
	 * Determines if admin.
	 *
	 * @return     boolean  True if admin, False otherwise.
	 */
	public static function is_admin()
	{
		return self::check(null, ['is_admin' => true]);
	}



	// check permission
	public static function check($_caller, $_args = null)
	{
		// only check group
		if(substr($_caller, 0, 7) === '_group_')
		{
			return self::check(substr($_caller, 7), ['check_group' => true]);
		}

		// only check plan
		if(substr($_caller, 0, 6) === '_plan_')
		{
			return self::check(substr($_caller, 6), ['check_plan' => true]);
		}

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

		$myPermission = \dash\user::detail('permission');

		// user have not any permission
		if(!$myPermission)
		{
			return false;
		}

		// needless to caller only check have permission and is staff
		if(isset($_args['only_check_has_permission']) && $_args['only_check_has_permission'] === true)
		{
			if($myPermission)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		// only check is admin not any caller
		if(isset($_args['is_admin']) && $_args['is_admin'] === true)
		{
			if($myPermission === 'admin' || $myPermission === 'supervisor')
			{
				return true;
			}
			else
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

		if(isset($_args['check_plan']) && $_args['check_plan'] === true)
		{
			// only check plan and this caller is exists on this plan
			return true;
		}

		// admin access to everything
		if($myPermission === 'admin' || $myPermission === 'supervisor')
		{
			return true;
		}


		$all_contain = \dash\app\permission\get::load_permission($myPermission);

		// permission not founded
		if(!$all_contain)
		{
			return false;
		}

		foreach ($all_contain as $group => $detail)
		{
			if(isset($detail['allow_access_title'][$_caller]) && $detail['allow_access_title'][$_caller])
			{
				// ok. Permission exists in allow access
				if(array_key_exists('status', $detail))
				{
					if($detail['status'])
					{
						// permission exists and status is true
						return true;
					}
					else
					{
						// permission exists but status is not true
						return false;
					}
				}
				else
				{
					// BUG! status not founded in json!
					return false;
				}
			}

			if(isset($detail['disallow_access_title'][$_caller]) && $detail['disallow_access_title'][$_caller])
			{
				if(isset($detail['access']) && $detail['access'] === 'full')
				{
					if(array_key_exists('status', $detail))
					{
						if($detail['status'])
						{
							// permission not exists but access is full and status is true
							return true;
						}
						else
						{
							// permission not exists and access is full and status is not true
							return false;
						}
					}
					else
					{
						// BUG! status not founded in json!
						return false;
					}
				}
				else
				{
					// user not access to this caller and access is not full
					return false;
				}
			}
		}

		if(isset($_args['check_group']) && $_args['check_group'] === true)
		{
			if(isset($all_contain[$_caller]['status']) && $all_contain[$_caller]['status'])
			{
				// only check group access
				return true;
			}
			else
			{
				return false;
			}
		}

		// not found this caller anywhere
		return false;
	}


	// check access
	public static function access($_caller, $_msg = null)
	{
		$check = self::check($_caller);

		if(!$check)
		{
			self::deny($_msg);
		}

		return true;
	}


	public static function deny($_msg = null)
	{
		if(!$_msg)
		{
			$_msg = T_("Permission denied");
		}

		\dash\header::status(403, $_msg);
	}
}
?>