<?php
namespace lib\app\product;


class company
{
	public static $debug = true;


	public static function fix()
	{

		$all = \dash\db::get("SELECT stores.company, stores.id FROM stores WHERE stores.company IS NOT NULL");

		if(!is_array($all) || !$all)
		{
			return;
		}

		$result = [];
		foreach ($all as $value)
		{
			$company = json_decode($value['company'], true);

			foreach ($company as  $title)
			{
				if($title['title'])
				{
					$new_insert =
					[
						'store_id' => $value['id'],
						'title' => $title['title'],
					];
					$get_company_title = \lib\db\productcompany::get_by_title($value['id'], $title['title']);

					if(isset($get_company_title['id']))
					{
						$new_company = $get_company_title['id'];
					}
					else
					{
						$new_company = \lib\db\productcompany::insert($new_insert);

					}


					if($new_company)
					{
						\lib\db\products::update_where(
						[
							'company'    => $title['title'],
							'company_id' => $new_company,
						],
						[
							'store_id' => $value['id'],
							'company'      => $title['title'],
						]);
					}
				}
			}
		}
		var_dump("OK");
	}


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

		$int = \dash\app::request('int') ? 1 : null;

		$default = \dash\app::request('companydefault') ? 1 : null;

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

		if($args['default'])
		{
			$get_company_title = \lib\db\productcompany::set_all_default_as_null(\lib\store::id());
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
		if(!\dash\permission::check('productCompanyListDelete'))
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

		if(isset($get_company['id']))
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

		if($args['default'])
		{
			\lib\db\productcompany::set_all_default_as_null(\lib\store::id());
		}

		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('int')) unset($args['int']);
		if(!\dash\app::isset_request('default')) unset($args['default']);
		if(!\dash\app::isset_request('maxsale')) unset($args['maxsale']);

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

				if(array_key_exists('title', $args))
				{
					// update all product by this company
					\lib\db\products\company::update_all_product_company_title(\lib\store::id(), $id, $args['title']);
				}

				if($update)
				{
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