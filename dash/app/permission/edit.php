<?php
namespace dash\app\permission;


class edit
{
	public static function edit_title($_args, $_id)
	{
		$condition =
		[
			'title'      => 'title',
		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$slug = \dash\validate::slug($data['title'], false);

		$load = \dash\app\permission\get::get($_id);
		if(!$load)
		{
			return false;
		}

		\lib\db\setting\update::key($data['title'], $_id);

		\dash\notif::ok(T_("Permission updated"));
		return true;

	}


	public static function advance_edit($_args, $_id)
	{
		if(!is_array($_args))
		{
			$_args = [];
		}

		$load = \dash\app\permission\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$old_value = $load['value'];

		$new_value = [];

		$list = \dash\permission::categorize_list();

		foreach ($_args as $group => $caller)
		{
			if(!is_array($caller))
			{
				\dash\notif::error(T_("Invalid permission group"));
				return false;
			}

			if(!isset($list[$group]['advance']) || (isset($list[$group]['advance']) && !is_array($list[$group]['advance'])))
			{
				\dash\notif::error(T_("Invalid permission group"));
				return false;
			}

			if(isset($old_value[$group]['status']) && $old_value[$group]['status'])
			{
				/* ok */
			}
			else
			{
				\dash\notif::error(T_("Can not costomized permission in deny mode!"));
				return false;
			}

			$advance = $list[$group]['advance'];

			$all_caller = array_column($advance, 'caller');

			foreach ($caller as $permission_caller => $access)
			{
				if(!in_array($permission_caller, $all_caller))
				{
					\dash\notif::error(T_("Invalid caller"));
					return false;
				}
				$access = $access ? true : false;

				$new_value[$group][$permission_caller] = $access;

			}
		}

		if(!$new_value)
		{
			\dash\notif::info(T_("No change in your permission"));
			return false;
		}


		foreach ($new_value as $group => $contain)
		{
			if(!isset($old_value[$group]))
			{
				\dash\notif::error(T_("Pleace open access to group :group first", ['group' => T_($group)]));
				return false;
			}

			$old_value[$group]['contain'] = [];

			foreach ($contain as $caller => $access)
			{
				if($access)
				{
					if(isset($old_value[$group]['contain']) && is_array($old_value[$group]['contain']))
					{
						if(in_array($caller, $old_value[$group]['contain']))
						{
							// nothing
						}
						else
						{
							$old_value[$group]['contain'][] = $caller;
						}
					}
					else
					{
						$old_value[$group]['contain'] = [$caller];
					}
				}
			}

			if(isset($old_value[$group]['contain']) && is_array($old_value[$group]['contain']))
			{
				if(count($old_value[$group]['contain']) === count($list[$group]['advance']))
				{

					$old_value[$group]['access'] = 'full';
				}
				else
				{
					$old_value[$group]['access'] = 'customized';

				}
			}
			else
			{
				$old_value[$group]['access'] = 'customized';
			}
		}

		$old_value = json_encode($old_value, JSON_UNESCAPED_UNICODE);
		\lib\db\setting\update::value($old_value, $load['id']);

		\dash\notif::ok(T_("Saved"));
		return true;

	}


	public static function edit($_args, $_id)
	{
		if(!is_array($_args))
		{
			$_args = [];
		}

		$load = \dash\app\permission\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$old_value = $load['value'];

		$list = \dash\permission::categorize_list();

		$keys = array_keys($list);

		$new_value = [];

		foreach ($keys as $group)
		{
			if(array_key_exists($group, $_args))
			{
				$new_value[$group] = \dash\validate::bool($_args[$group]);
			}
		}

		if(!$new_value)
		{
			\dash\notif::info(T_("No change in your permission"));
			return false;
		}

		foreach ($new_value as $key => $value)
		{
			if(!isset($old_value[$key]))
			{
				if($value)
				{
					$old_value[$key] = ['status' => true, 'access' => 'full'];

				}
				else
				{
					$old_value[$key] = ['status' => false, 'access' => null];
				}
			}
			else
			{
				if($value)
				{
					$old_value[$key]['status'] = true;
				}
				else
				{
					$old_value[$key]['status'] = false;
				}
			}
		}


		$old_value = json_encode($old_value, JSON_UNESCAPED_UNICODE);
		\lib\db\setting\update::value($old_value, $load['id']);

		\dash\notif::ok(T_("Saved"));
		return true;

	}
}
?>