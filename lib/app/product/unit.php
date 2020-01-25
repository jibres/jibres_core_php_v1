<?php
namespace lib\app\product;


class unit
{
	public static $debug = true;


	public static function check_add($_unit)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$get_unit_title = \lib\db\productunit\get::by_title($_unit);
		if(isset($get_unit_title['id']))
		{
			return $get_unit_title;
		}

		if(!self::check_title($_unit))
		{
			return false;
		}

		$args =
		[
			'title' => $_unit,
		];

		$id = \lib\db\productunit\insert::new_record($args);

		if(!$id)
		{
			\dash\log::set('productUnitDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		$result          = [];
		$result['id']    = $id;
		$result['title'] = $_unit;

		return $result;
	}



	private static function check_title($_title)
	{
		$title = $_title;
		if(!is_string($title))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

		if(!$title && $title !== '0')
		{
			\dash\notif::error(T_("Plese fill the unit name"), 'unit');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Unit name is too large!"), 'unit');
			return false;
		}

		return true;
	}



	private static function check($_id = null)
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			if(self::$debug) \dash\notif::error(T_("Plese fill the unit name"), 'unit');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			if(self::$debug) \dash\notif::error(T_("Unit name is too large!"), 'unit');
			return false;
		}

		$int = \dash\app::request('int') ? 1 : null;



		$args            = [];
		$args['title']   = $title;
		$args['int']     = $int;

		return $args;

	}


	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productUnitListAdd'))
		{
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_unit_title = \lib\db\productunit\get::by_title($args['title']);

		if(isset($get_unit_title['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate unit founded"), 'unit');
			return false;
		}


		$id = \lib\db\productunit\insert::new_record($args);
		if(!$id)
		{
			\dash\log::set('productUnitDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		if(self::$debug)
		{
			\dash\notif::ok(T_("Unit successfully added"));
		}

		$result       = [];
		$result['id'] = $id;
		return $result;
	}


	public static function remove($_args, $_id)
	{
		if(!\dash\permission::check('productUnitDelete'))
		{
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		\dash\app::variable($_args);

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$id = $_id;
		if(!$id || !is_numeric($id))
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$count_product = \lib\db\productunit\get::count_unit($id);
		$count_product = intval($count_product);

		if($count_product > 0)
		{
			$whattodo = \dash\app::request('whattodo');
			if(!in_array($whattodo, ['non-unit','new-unit']))
			{
				\dash\notif::error(T_("What to do for old unit?"));
				return false;
			}

			$check = null;

			$unit = \dash\app::request('unit');
			if($unit)
			{
				$check = self::inline_get($unit);
				if(!$check)
				{
					\dash\notif::error(T_("Invalid new unit id!"));
					return false;
				}
			}

			if($whattodo === 'new-unit' && !isset($check['id']))
			{
				\dash\notif::error(T_("Please select one unit"), 'unit');
				return false;
			}

			$old_unit_id    = $_id;
			if(!$old_unit_id || !is_numeric($old_unit_id))
			{
				\dash\notif::error(T_("Invalid unit id!"));
				return false;
			}

			if($whattodo === 'new-unit')
			{
				$new_unit_id    = $check['id'];
				$new_unit_title = $check['title'];

				\lib\db\products\update::update_all_unit($new_unit_id, $old_unit_id);
			}
			else
			{
				\lib\db\products\update::clean_all_unit($old_unit_id);

			}
		}

		\dash\log::set('productUnitDeleted', ['old' => $load]);

		\lib\db\productunit\delete::record($id);
		if(self::$debug)
		{
			\dash\notif::ok(T_("Unit successfully removed"));
		}
		return true;
	}


	public static function inline_get($_id)
	{
		$id = $_id;
		if(!$id || !is_numeric($id))
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$load = \lib\db\productunit\get::one($id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productUnitListView');

		$id = $_id;
		if(!$id || !is_numeric($id))
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$load = \lib\db\productunit\get::one($id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		// $load['count'] = \lib\db\productunit\get::get_count_unit($id);
		$load = self::ready($load);
		return $load;
	}



	public static function edit($_args, $_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productUnitListEdit'))
		{
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		\dash\app::variable($_args);

		$id = $_id;
		if(!$id || !is_numeric($id))
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_unit = \lib\db\productunit\get::one($id);

		if(isset($get_unit['id']) && isset($get_unit['title']) && $get_unit['title'] == $args['title'])
		{
			if(intval($get_unit['id']) === intval($id))
			{
				// nothing
			}
			else
			{
				if(self::$debug) \dash\notif::error(T_("Duplicate unit founded"), 'unit');
				return false;
			}
		}

		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('int')) unset($args['int']);


		if(!empty($args))
		{
			foreach ($get_unit as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your product unit"));
				return null;
			}
			else
			{
				$update = \lib\db\productunit\update::record($args, $id);

				if($update)
				{

					\dash\log::set('productUnitUpdated', ['old' => $get_unit, 'change' => $args]);

					\dash\notif::ok(T_("The unit successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('productunitDbCannotUpdate');
					\dash\notif::error(T_("Can not update your product unit"));
					return false;
				}
			}
		}
		else
		{
			\dash\notif::error(T_("No data received!"));
			return false;
		}
	}


	public static function list($_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productUnitListView');


		$result = \lib\db\productunit\get::list();

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	private static function ready($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				// case 'id':
				// 	$result[$key] = \dash\coding::encode($value);
				// 	break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>