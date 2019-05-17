<?php
namespace lib\app\product;


class unit
{
	public static $debug = true;


	public static function fix()
	{

		$all = \dash\db::get("SELECT stores.unit, stores.id FROM stores WHERE stores.unit IS NOT NULL");

		if(!is_array($all) || !$all)
		{
			return;
		}

		$result = [];
		foreach ($all as $value)
		{
			$unit = json_decode($value['unit'], true);

			foreach ($unit as  $title)
			{
				if($title['title'])
				{
					$new_insert =
					[
						'store_id' => $value['id'],
						'title' => $title['title'],
					];
					$get_unit_title = \lib\db\productunit::get_by_title($value['id'], $title['title']);

					if(isset($get_unit_title['id']))
					{
						$new_unit = $get_unit_title['id'];
					}
					else
					{
						$new_unit = \lib\db\productunit::insert($new_insert);

					}


					if($new_unit)
					{
						\lib\db\products::update_where(
						[
							'unit'    => $title['title'],
							'unit_id' => $new_unit,
						],
						[
							'store_id' => $value['id'],
							'unit'      => $title['title'],
						]);
					}
				}
			}
		}
		var_dump("OK");
	}


	public static function check_add($_unit)
	{
		$get_unit_title = \lib\db\productunit::get_by_title(\lib\store::id(), $_unit);
		if(isset($get_unit_title['id']))
		{
			return $get_unit_title;
		}

		$args =
		[
			'title' => $_unit,
			'store_id' => \lib\store::id(),
		];

		$id = \lib\db\productunit::insert($args);

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

		$default = \dash\app::request('unitdefault') ? 1 : null;

		$maxsale = \dash\app::request('maxsale');
		if($maxsale && !is_numeric($maxsale))
		{
			if(self::$debug) \dash\notif::error(T_("Plese set the max sale as a number"), 'maxsale');
			return false;
		}

		if($maxsale)
		{
			$maxsale = abs(intval($maxsale));
			if($maxsale > 1E+9)
			{
				if(self::$debug) \dash\notif::error(T_("Max sale is out of range"), 'maxsale');
				return false;
			}
		}

		$args            = [];
		$args['title']   = $title;
		$args['int'] = $int;
		$args['default'] = $default;
		$args['maxsale'] = $maxsale;
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

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_unit_title = \lib\db\productunit::get_by_title(\lib\store::id(), $args['title']);

		if(isset($get_unit_title['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate unit founded"), 'unit');
			return false;
		}

		if($args['default'])
		{
			$get_unit_title = \lib\db\productunit::set_all_default_as_null(\lib\store::id());
		}

		$args['store_id'] = \lib\store::id();

		$id = \lib\db\productunit::insert($args);
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
		$result['id'] = \dash\coding::encode($id);
		return $result;
	}


	public static function remove($_args, $_id)
	{
		if(!\dash\permission::check('productUnitListDelete'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$id = \dash\coding::decode($_id);

		$count_product = \lib\db\products::get_count_unit(\lib\store::id(), $id);
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

			$old_unit_id    = \dash\coding::decode($_id);

			if($whattodo === 'new-unit')
			{
				$new_unit_id    = $check['id'];
				$new_unit_title = $check['title'];

				\lib\db\products::update_all_product_by_unit(\lib\store::id(), $new_unit_id, $new_unit_title, $old_unit_id);
			}
			else
			{
				\lib\db\products::update_all_product_by_unit(\lib\store::id(), null, null, $old_unit_id);
			}
		}

		\lib\db\productunit::delete($id);
		if(self::$debug)
		{
			\dash\notif::ok(T_("Unit successfully removed"));
		}
		return true;
	}


	public static function inline_get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$load = \lib\db\productunit::get_one(\lib\store::id(), $id);
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

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$load = \lib\db\productunit::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$load['count'] = \lib\db\products::get_count_unit(\lib\store::id(), $id);
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

		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_unit = \lib\db\productunit::get_one(\lib\store::id(), $id);

		if(isset($get_unit['id']))
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

		if($args['default'])
		{
			\lib\db\productunit::set_all_default_as_null(\lib\store::id());
		}

		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('int')) unset($args['int']);
		if(!\dash\app::isset_request('default')) unset($args['default']);
		if(!\dash\app::isset_request('maxsale')) unset($args['maxsale']);

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
				$update = \lib\db\productunit::update($args, $id);

				if(array_key_exists('title', $args))
				{
					// update all product by this unit
					\lib\db\products::update_all_product_unit_title(\lib\store::id(), $id, $args['title']);
				}

				if($update)
				{
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


		$result = \lib\db\productunit::get_list(\lib\store::id());

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
				case 'id':
					$result[$key] = \dash\coding::encode($value);
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>