<?php
namespace dash\app\permission;


class get
{
	public static function get($_id, $_ready = false)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}


		$load = \lib\db\setting\get::by_id($id);

		if(isset($load['id']) && isset($load['cat']) && $load['cat'] === 'permission')
		{
			// ok nothing
		}
		else
		{
			\dash\notif::error(T_("Invalid permission id"));
			return false;
		}

		if(isset($load['value']) && is_string($load['value']))
		{
			$load['value'] = json_decode($load['value'], true);
		}

		if(isset($load['value']) && is_array($load['value']))
		{
			// ok nothing
		}
		else
		{
			$load['value'] = [];
		}


		if($_ready)
		{
			self::ready($load);
		}

		return $load;

	}


	private static function ready(&$load)
	{
		$list = \dash\permission::categorize_list();

		foreach ($load['value'] as $key => $value)
		{
			if(!isset($value['contain']))
			{
				$value['contain'] = [];
			}
			if(isset($value['access']) && isset($value['contain']) && is_array($value['contain']))
			{
				$contain = $value['contain'];
				if(isset($list[$key]['advance']) && is_array($list[$key]['advance']))
				{

					foreach ($list[$key]['advance'] as  $caller_detail)
					{
						if(in_array($caller_detail['caller'], $contain))
						{
							if(!isset($load['value'][$key]['allow_access_title']))
							{
								$load['value'][$key]['allow_access_title'] = [];
							}

							$load['value'][$key]['allow_access_title'][$caller_detail['caller']] = $caller_detail['title'];
						}
						else
						{
							if(!isset($load['value'][$key]['disallow_access_title']))
							{
								$load['value'][$key]['disallow_access_title'] = [];
							}

							$load['value'][$key]['disallow_access_title'][$caller_detail['caller']] = $caller_detail['title'];
						}
					}

				}
			}
		}
	}


	public static function list()
	{
		$list = \lib\db\setting\get::by_cat('permission');

		if(!is_array($list))
		{
			$list = [];
		}

		return $list;

	}


	/**
	 * save loaded permission to not load again in one request
	 *
	 * @var        array
	 */
	private static $load_permission = [];


	/**
	 * Loads a permission.
	 *
	 * @param      <type>   $_permission_name  The permission name
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function load_permission($_permission_name)
	{
		if(isset(self::$load_permission[$_permission_name]))
		{
			return self::$load_permission[$_permission_name];
		}

		$load = \lib\db\setting\get::by_cat_key('permission', $_permission_name);

		if(!$load || !is_array($load) || !isset($load['id']) || !isset($load['value']))
		{
			return false;
		}

		if(isset($load['id']) && isset($load['cat']) && $load['cat'] === 'permission')
		{
			// ok nothing
		}
		else
		{
			return false;
		}

		if(isset($load['value']) && is_string($load['value']))
		{
			$load['value'] = json_decode($load['value'], true);
		}

		if(isset($load['value']) && is_array($load['value']))
		{
			// ok nothing
		}
		else
		{
			$load['value'] = [];
		}


		self::ready($load);

		self::$load_permission[$_permission_name] = $load['value'];

		return $load['value'];
	}

}
?>