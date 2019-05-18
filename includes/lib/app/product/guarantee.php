<?php
namespace lib\app\product;


class guarantee
{
	public static $debug = true;


	public static function fix()
	{

		$all = \dash\db::get("SELECT products.guarantee, products.store_id FROM products WHERE products.guarantee IS NOT NULL GROUP BY products.guarantee, products.store_id");

		if(!is_array($all) || !$all)
		{
			return;
		}

		$result = [];
		foreach ($all as $value)
		{

			$new_insert =
			[
				'store_id' => $value['store_id'],
				'title' => $value['guarantee'],
			];
			$get_guarantee_title = \lib\db\productguarantee::get_by_title($value['store_id'], $value['guarantee']);

			if(isset($get_guarantee_title['id']))
			{
				$new_guarantee = $get_guarantee_title['id'];
			}
			else
			{
				$new_guarantee = \lib\db\productguarantee::insert($new_insert);

			}


			if($new_guarantee)
			{
				\lib\db\products::update_where(
				[
					'guarantee'    => $value['guarantee'],
					'guarantee_id' => $new_guarantee,
				],
				[
					'store_id' => $value['store_id'],
					'guarantee'      => $value['guarantee'],
				]);
			}
		}
		var_dump("OK");
	}


	public static function check_add($_guarantee)
	{
		$get_guarantee_title = \lib\db\productguarantee::get_by_title(\lib\store::id(), $_guarantee);
		if(isset($get_guarantee_title['id']))
		{
			return $get_guarantee_title;
		}

		$args =
		[
			'title' => $_guarantee,
			'store_id' => \lib\store::id(),
		];

		$id = \lib\db\productguarantee::insert($args);

		if(!$id)
		{
			\dash\log::set('productGuaranteeDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		$result          = [];
		$result['id']    = $id;
		$result['title'] = $_guarantee;

		return $result;
	}


	private static function check($_id = null)
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			if(self::$debug) \dash\notif::error(T_("Plese fill the guarantee name"), 'guarantee');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			if(self::$debug) \dash\notif::error(T_("Guarantee name is too large!"), 'guarantee');
			return false;
		}

		$args            = [];
		$args['title']   = $title;

		return $args;

	}


	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productGuaranteeListAdd'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_guarantee_title = \lib\db\productguarantee::get_by_title(\lib\store::id(), $args['title']);

		if(isset($get_guarantee_title['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate guarantee founded"), 'guarantee');
			return false;
		}

		$args['store_id'] = \lib\store::id();

		$id = \lib\db\productguarantee::insert($args);
		if(!$id)
		{
			\dash\log::set('productGuaranteeDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		if(self::$debug)
		{
			\dash\notif::ok(T_("Guarantee successfully added"));
		}

		$result       = [];
		$result['id'] = \dash\coding::encode($id);
		return $result;
	}


	public static function remove($_args, $_id)
	{
		if(!\dash\permission::check('productGuaranteeListDelete'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid guarantee id"));
			return false;
		}

		$id = \dash\coding::decode($_id);

		$count_product = \lib\db\products\guarantee::get_count_guarantee(\lib\store::id(), $id);
		$count_product = intval($count_product);

		if($count_product > 0)
		{
			$whattodo = \dash\app::request('whattodo');
			if(!in_array($whattodo, ['non-guarantee','new-guarantee']))
			{
				\dash\notif::error(T_("What to do for old guarantee?"));
				return false;
			}

			$check = null;

			$guarantee = \dash\app::request('guarantee');
			if($guarantee)
			{
				$check = self::inline_get($guarantee);
				if(!$check)
				{
					\dash\notif::error(T_("Invalid new guarantee id!"));
					return false;
				}
			}

			if($whattodo === 'new-guarantee' && !isset($check['id']))
			{
				\dash\notif::error(T_("Please select one guarantee"), 'guarantee');
				return false;
			}

			$old_guarantee_id    = \dash\coding::decode($_id);

			if($whattodo === 'new-guarantee')
			{
				$new_guarantee_id    = $check['id'];
				$new_guarantee_title = $check['title'];

				\lib\db\products\guarantee::update_all_product_by_guarantee(\lib\store::id(), $new_guarantee_id, $new_guarantee_title, $old_guarantee_id);
			}
			else
			{
				\lib\db\products\guarantee::update_all_product_by_guarantee(\lib\store::id(), null, null, $old_guarantee_id);
			}
		}

		\dash\log::set('productGuaranteeDeleted', ['old' => $load]);

		\lib\db\productguarantee::delete($id);
		if(self::$debug)
		{
			\dash\notif::ok(T_("Guarantee successfully removed"));
		}
		return true;
	}


	public static function inline_get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid guarantee id"));
			return false;
		}

		$load = \lib\db\productguarantee::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid guarantee id"));
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

		\dash\permission::access('productGuaranteeListView');

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid guarantee id"));
			return false;
		}

		$load = \lib\db\productguarantee::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid guarantee id"));
			return false;
		}

		$load['count'] = \lib\db\products\guarantee::get_count_guarantee(\lib\store::id(), $id);
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

		if(!\dash\permission::check('productGuaranteeListEdit'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid guarantee id"));
			return false;
		}

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_guarantee = \lib\db\productguarantee::get_one(\lib\store::id(), $id);

		if(isset($get_guarantee['id']))
		{
			if(intval($get_guarantee['id']) === intval($id))
			{
				// nothing
			}
			else
			{
				if(self::$debug) \dash\notif::error(T_("Duplicate guarantee founded"), 'guarantee');
				return false;
			}
		}


		if(!\dash\app::isset_request('title')) unset($args['title']);


		if(!empty($args))
		{
			foreach ($get_guarantee as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your product guarantee"));
				return null;
			}
			else
			{
				$update = \lib\db\productguarantee::update($args, $id);

				if($update)
				{
					\dash\log::set('productGuaranteeUpdated', ['old' => $get_guarantee, 'change' => $args]);

					if(array_key_exists('title', $args))
					{
						// update all product by this guarantee
						\lib\db\products\guarantee::update_all_product_guarantee_title(\lib\store::id(), $id, $args['title']);
					}

					\dash\notif::ok(T_("The guarantee successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('productguaranteeDbCannotUpdate');
					\dash\notif::error(T_("Can not update your product guarantee"));
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

	public static function page_list($_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productGuaranteeListView');


		$result = \lib\db\productguarantee::get_page_list(\lib\store::id(), $_string);

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

	public static function list($_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productGuaranteeListView');


		$result = \lib\db\productguarantee::get_list(\lib\store::id());

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