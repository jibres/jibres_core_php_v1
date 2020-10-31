<?php
namespace lib\app\product;


class company
{
	public static $debug = true;


	public static function check_add($_company)
	{
		$_company = \dash\validate::string_100($_company);

		if(!$_company)
		{
			return;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$get_company_title = \lib\db\productcompany\get::by_title($_company);
		if(isset($get_company_title['id']))
		{
			return $get_company_title;
		}

		$args =
		[
			'title' => $_company,
		];

		$id = \lib\db\productcompany\insert::new_record($args);

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


	public static function add($_args)
	{

		if(!\dash\permission::check('manageProductCompany'))
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
			'title'    => 'title',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$get_company_title = \lib\db\productcompany\get::by_title($data['title']);

		if(isset($get_company_title['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate company founded"), 'company');
			return false;
		}


		$id = \lib\db\productcompany\insert::new_record($data);
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
		$result['id'] = $id;
		return $result;
	}


	public static function remove($_args, $_id)
	{
		if(!\dash\permission::check('manageProductCompany'))
		{
			return false;
		}

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$condition =
		[
			'content'  => 'desc',
			'whattodo' => ['enum' => ['non-company','new-company']],
			'company'  => 'string_50',

		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$count_product = \lib\db\productcompany\get::count_company($id);
		$count_product = floatval($count_product);

		if($count_product > 0)
		{

			$check = null;

			if($data['company'])
			{
				$check = self::inline_get($data['company']);
				if(!$check)
				{
					\dash\notif::error(T_("Invalid new company id!"));
					return false;
				}
			}

			if($data['whattodo'] === 'new-company' && !isset($check['id']))
			{
				\dash\notif::error(T_("Please select one company"), 'company');
				return false;
			}

			$old_company_id    = $id;
			if(!$old_company_id || !is_numeric($old_company_id))
			{
				\dash\notif::error(T_("Invalid company id!"));
				return false;
			}

			if($data['whattodo'] === 'new-company')
			{
				$new_company_id    = $check['id'];
				$new_company_title = $check['title'];

				if($new_company_id == $old_company_id)
				{
					\dash\notif::error(T_("Old company is equal to new company id"));
					return false;
				}

				\lib\db\products\update::update_all_company($new_company_id, $old_company_id);
			}
			else
			{
				\lib\db\products\update::clean_all_company($old_company_id);

			}
		}

		\dash\log::set('productCompanyDeleted', ['old' => $load]);

		\lib\db\productcompany\delete::record($id);
		if(self::$debug)
		{
			\dash\notif::ok(T_("Company successfully removed"));
		}
		return true;
	}


	public static function inline_get($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$load = \lib\db\productcompany\get::one($id);
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

		\dash\permission::access('_group_products');

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$load = \lib\db\productcompany\get::one($id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		// $load['count'] = \lib\db\productcompany\get::get_count_company($id);
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

		if(!\dash\permission::check('manageProductCompany'))
		{
			return false;
		}

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid company id"));
			return false;
		}

		$condition =
		[
			'title'    => 'title',
		];

		$require = [];
		$meta    =	[];

		$args = \dash\cleanse::input($_args, $condition, $require, $meta);



		$get_company = \lib\db\productcompany\get::one($id);

		if(isset($get_company['id']) && isset($get_company['title']) && $get_company['title'] == $args['title'])
		{
			if(floatval($get_company['id']) === floatval($id))
			{
				// nothing
			}
			else
			{
				if(self::$debug) \dash\notif::error(T_("Duplicate company founded"), 'company');
				return false;
			}
		}


		$args = \dash\cleanse::patch_mode($_args, $args);

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
				$update = \lib\db\productcompany\update::record($args, $id);

				if($update)
				{

					\dash\log::set('productCompanyUpdated', ['old' => $get_company, 'change' => $args]);

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

		\dash\permission::access('_group_products');


		$result = \lib\db\productcompany\get::list();

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