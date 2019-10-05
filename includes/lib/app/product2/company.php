<?php
namespace lib\app\product2;


class company
{
	public static $debug = true;


	public static function check_add($_company)
	{
		$get_company_title = \lib\db\productcompany::get_by_title(\lib\store::id(), $_company);
		if(isset($get_company_title['id']))
		{
			return $get_company_title;
		}

		$args =
		[
			'title' => $_company,
			'store_id' => \lib\store::id(),
		];

		$id = \lib\db\productcompany::insert($args);

		if(!$id)
		{
			\dash\log::set('productCompanyDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		$result          = [];
		$result['id']    = $id;
		$result['title'] = $_company;

		return $result;
	}


	private static function check($_id = null)
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			if(self::$debug) \dash\notif::error(T_("Plese fill the company name"), 'company');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			if(self::$debug) \dash\notif::error(T_("Company name is too large!"), 'company');
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

		if(!\dash\permission::check('productCompanyListAdd'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_company_title = \lib\db\productcompany::get_by_title(\lib\store::id(), $args['title']);

		if(isset($get_company_title['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate company founded"), 'company');
			return false;
		}

		$args['store_id'] = \lib\store::id();

		$id = \lib\db\productcompany::insert($args);
		if(!$id)
		{
			\dash\log::set('productCompanyDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		if(self::$debug)
		{
			\dash\notif::ok(T_("Company successfully added"));
		}

		$result       = [];
		$result['id'] = \dash\coding::encode($id);
		return $result;
	}


	public static function remove($_args, $_id)
	{
		if(!\dash\permission::check('productCompanyDelete'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$id = \dash\coding::decode($_id);

		$count_product = \lib\db\products\company::get_count_company(\lib\store::id(), $id);
		$count_product = intval($count_product);

		if($count_product > 0)
		{
			$whattodo = \dash\app::request('whattodo');
			if(!in_array($whattodo, ['non-company','new-company']))
			{
				\dash\notif::error(T_("What to do for old company?"));
				return false;
			}

			$check = null;

			$company = \dash\app::request('company');
			if($company)
			{
				$check = self::inline_get($company);
				if(!$check)
				{
					\dash\notif::error(T_("Invalid new company id!"));
					return false;
				}
			}

			if($whattodo === 'new-company' && !isset($check['id']))
			{
				\dash\notif::error(T_("Please select one company"), 'company');
				return false;
			}

			$old_company_id    = \dash\coding::decode($_id);

			if($whattodo === 'new-company')
			{
				$new_company_id    = $check['id'];
				$new_company_title = $check['title'];

				\lib\db\products\company::update_all_product_by_company(\lib\store::id(), $new_company_id, $new_company_title, $old_company_id);
			}
			else
			{
				\lib\db\products\company::update_all_product_by_company(\lib\store::id(), null, null, $old_company_id);
			}
		}

		\dash\log::set('productCompanyDeleted', ['old' => $load]);

		\lib\db\productcompany::delete($id);
		if(self::$debug)
		{
			\dash\notif::ok(T_("Company successfully removed"));
		}
		return true;
	}


	public static function inline_get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$load = \lib\db\productcompany::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid company id"));
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

		\dash\permission::access('productCompanyListView');

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$load = \lib\db\productcompany::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$load['count'] = \lib\db\products\company::get_count_company(\lib\store::id(), $id);
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

		if(!\dash\permission::check('productCompanyListEdit'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_company = \lib\db\productcompany::get_one(\lib\store::id(), $id);

		if(isset($get_company['id']) && isset($get_company['title']) && $get_company['title'] == $args['title'])
		{
			if(intval($get_company['id']) === intval($id))
			{
				// nothing
			}
			else
			{
				if(self::$debug) \dash\notif::error(T_("Duplicate company founded"), 'company');
				return false;
			}
		}


		if(!\dash\app::isset_request('title')) unset($args['title']);


		if(!empty($args))
		{
			foreach ($get_company as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your product company"));
				return null;
			}
			else
			{
				$update = \lib\db\productcompany::update($args, $id);

				if($update)
				{
					\dash\log::set('productCompanyUpdated', ['old' => $get_company, 'change' => $args]);

					if(array_key_exists('title', $args))
					{
						// update all product by this company
						\lib\db\products\company::update_all_product_company_title(\lib\store::id(), $id, $args['title']);
					}

					\dash\notif::ok(T_("The company successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('productcompanyDbCannotUpdate');
					\dash\notif::error(T_("Can not update your product company"));
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

		\dash\permission::access('productCompanyListView');


		$result = \lib\db\productcompany::get_page_list(\lib\store::id(), $_string);

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

		\dash\permission::access('productCompanyListView');


		$result = \lib\db\productcompany::get_list(\lib\store::id());

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