<?php
namespace lib\app\product;


class unit
{
	public static $debug = true;


	public static function check_add($_unit)
	{
		$_unit = \dash\validate::string_100($_unit);

		if(!$_unit)
		{
			return;
		}

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


	public static function add($_args)
	{

		if(!\dash\permission::check('mamageProductUnit'))
		{
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$condition =
		[
			'title' => 'title',
			'int'   => 'bit',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$get_unit_title = \lib\db\productunit\get::by_title($data['title']);

		if(isset($get_unit_title['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate unit founded"), 'unit');
			return false;
		}


		$id = \lib\db\productunit\insert::new_record($data);
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
		if(!\dash\permission::check('mamageProductUnit'))
		{
			return false;
		}

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$condition =
		[
			'content'  => 'desc',
			'whattodo' => ['enum' => ['non-unit','new-unit']],
			'unit'  => 'string_50',

		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$count_product = \lib\db\productunit\get::count_unit($id);
		$count_product = floatval($count_product);

		if($count_product > 0)
		{

			$check = null;

			if($data['unit'])
			{
				$check = self::inline_get($data['unit']);
				if(!$check)
				{
					\dash\notif::error(T_("Invalid new unit id!"));
					return false;
				}
			}

			if($data['whattodo'] === 'new-unit' && !isset($check['id']))
			{
				\dash\notif::error(T_("Please select one unit"), 'unit');
				return false;
			}

			$old_unit_id    = $id;
			if(!$old_unit_id || !is_numeric($old_unit_id))
			{
				\dash\notif::error(T_("Invalid unit id!"));
				return false;
			}

			if($data['whattodo'] === 'new-unit')
			{
				$new_unit_id    = $check['id'];
				$new_unit_title = $check['title'];

				if($new_unit_id == $old_unit_id)
				{
					\dash\notif::error(T_("Old unit is equal to new unit id"));
					return false;
				}

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
		$id = \dash\validate::id($_id);
		if(!$id)
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

		\dash\permission::access('_group_products');

		$id = \dash\validate::id($_id);

		if(!$id)
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

		if(!\dash\permission::check('mamageProductUnit'))
		{
			return false;
		}

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid unit id"));
			return false;
		}

		$condition =
		[
			'title' => 'title',
			'int'   => 'bit',
		];

		$require = [];
		$meta    =	[];

		$args = \dash\cleanse::input($_args, $condition, $require, $meta);



		$get_unit = \lib\db\productunit\get::one($id);

		if(isset($get_unit['id']) && isset($get_unit['title']) && $get_unit['title'] == $args['title'])
		{
			if(floatval($get_unit['id']) === floatval($id))
			{
				// nothing
			}
			else
			{
				if(self::$debug) \dash\notif::error(T_("Duplicate unit founded"), 'unit');
				return false;
			}
		}


		$args = \dash\cleanse::patch_mode($_args, $args);

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

		\dash\permission::access('_group_products');


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