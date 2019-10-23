<?php
namespace lib\app\store;


class add
{

	public static function trial($_args)
	{
		\dash\app::variable($_args);

		$user_id = \dash\user::id();
		if(!$user_id)
		{
			\dash\notif::warn(T_("Please login to continue"));
			return false;
		}

		// check title
		$title = \dash\app::request('title');
		if(!$title)
		{
			\dash\notif::error(T_("Please fill the store title"), 'title');
			return false;
		}

		if(mb_strlen($title) >= 200)
		{
			\dash\notif::error(T_("Please fill the store title less than 200 character"), 'title');
			return false;
		}

		$subdomain = \dash\app::request('subdomain');
		$subdomain = \lib\app\store\subdomain::validate($subdomain);
		if(!$subdomain)
		{
			return false;
		}

		$check_exist = \lib\db\store\check::subdomain_exist($subdomain);
		if($check_exist)
		{
			\dash\notif::error(T_("This subdomain is already occupied"), 'subdomain');
			return false;
		}

		// create new store by free plan
		// just check count of free plan store
		// check store count

		$count_store_free = intval(\lib\db\store\get::count_free_trial($user_id));

		if($count_store_free >= 1)
		{
			$user_budget = \dash\db\transactions::budget($user_id, ['unit' => 'toman']);

			$user_budget = floatval($user_budget);

			if($user_budget < 10000)
			{
				if(\dash\permission::supervisor())
				{
					\dash\notif::warn(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
				}
				else
				{
					\dash\notif::error(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
					return false;
				}
			}
		}

		if($count_store_free >= 2)
		{
			$msg = T_("You can not have more than two free or trial stores.");

			if(\dash\url::isLocal())
			{
				\dash\notif::warn($msg. "\n". T_("This msg in local is warn and in site is error :)"));
			}
			else
			{
				\dash\notif::error($msg);
				return false;
			}
		}

		$args               = [];
		$args['owner']      = $user_id;
		$args['creator']    = $user_id;
		$args['title']      = $title;
		$args['subdomain']  = $subdomain;
		$args['startplan']  = date("Y-m-d H:i:s");
		$args['expireplan'] = date("Y-m-d H:i:s", strtotime("+14 days"));
		$args['plan']       = 'trial';

		\dash\db::transaction();

		$store_id = self::new_store($subdomain, $args['creator']);

		if(!$store_id)
		{
			\dash\db::rollback();

			\dash\log::set('dbCanNotAddStore', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			return false;
		}

		$add_store_data = self::new_store_data($args, $store_id);

		if(!$add_store_data)
		{
			\dash\db::rollback();

			\dash\log::set('dbCanNotAddStoreData', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			return false;
		}

		$add_store_plan = self::new_store_plan($args, $store_id);

		if(!$add_store_plan)
		{
			\dash\db::rollback();

			\dash\log::set('dbCanNotAddStorePlan', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			return false;
		}


		$add_store_user = self::new_store_user($args, $store_id);

		if(!$add_store_user)
		{
			\dash\db::rollback();

			\dash\log::set('dbCanNotAddStoreUser', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			return false;
		}

		\dash\db::commit();

		// create database of store customer
		$create_db = \lib\app\store\db::create($store_id);

		if($create_db)
		{
			$create_detail_file = self::create_detail_file($store_id);

			$create_subdomain_file = self::create_subdomain_file($store_id, $subdomain);

			\dash\notif::ok(T_("Your store created"));
			
			return true;
		}
		else
		{
			\dash\notif::error(T_("We can not create your store!"));

			\dash\log::set('createStoreDbOkCustormeDataBaseNOK', ['request_subdomain' => $subdomain, 'store_id' => $store_id]);

			return false;
		}
	}


	private static function new_store($_subdomain, $_creator)
	{
		$new_store                = [];
		$new_store['subdomain']   = $_subdomain;
		$new_store['dbip']        = ip2long('192.168.1.1');
		$new_store['creator']     = $_creator;
		$new_store['ip']          = \dash\server::ip(true);
		$new_store['datecreated'] = date("Y-m-d H:i:s");

		$new_store_id = \lib\db\store\insert::store($new_store);

		return $new_store_id;
	}


	private static function new_store_data($_args, $_id)
	{
		$new_store_data                  = [];
		$new_store_data['id']            = $_id;
		$new_store_data['title']         = $_args['title'];
		$new_store_data['owner']         = $_args['owner'];
		$new_store_data['description']   = null;
		$new_store_data['lang']          = null;
		$new_store_data['unit']          = null;
		$new_store_data['country']       = null;
		$new_store_data['domain1']       = null;
		$new_store_data['domain2']       = null;
		$new_store_data['domain3']       = null;
		$new_store_data['status']        = 'enable';
		$new_store_data['logo']          = null;
		$new_store_data['plan']          = $_args['plan'];
		$new_store_data['startplan']     = $_args['startplan'];
		$new_store_data['expireplan']    = $_args['expireplan'];
		$new_store_data['lastactivity']  = date("Y-m-d H:i:s");
		$new_store_data['dbversion']     = null;
		$new_store_data['dbversiondate'] = null;
		$new_store_data['datecreated']   = date("Y-m-d H:i:s");;

		$result = \lib\db\store\insert::store_data($new_store_data);

		return $result;
	}


	private static function new_store_plan($_args, $_id)
	{
		$new_store_plan                = [];
		$new_store_plan['store_id']    = $_id;
		$new_store_plan['user_id']     = $_args['creator'];
		$new_store_plan['plan']        = $_args['plan'];
		$new_store_plan['start']       = $_args['startplan'];
		$new_store_plan['end']         = null;
		$new_store_plan['type']        = 'set';
		$new_store_plan['description'] = null;
		$new_store_plan['status']      = 'enable';
		$new_store_plan['price']       = null;
		$new_store_plan['discount']    = null;
		$new_store_plan['promo']       = null;
		$new_store_plan['period']      = null;
		$new_store_plan['expireplan']  = $_args['expireplan'];
		$new_store_plan['datecreated'] = date("Y-m-d H:i:s");

		$result = \lib\db\store\insert::store_plan($new_store_plan);

		return $result;
	}


	private static function new_store_user($_args, $_id)
	{
		$new_store_user                = [];
		$new_store_user['store_id']    = $_id;
		$new_store_user['creator']     = $_args['creator'];
		$new_store_user['user_id']     = $_args['creator'];
		$new_store_user['staff']       = 'yes';
		$new_store_user['datecreated'] = date("Y-m-d H:i:s");

		$result = \lib\db\store\insert::store_user($new_store_user);

		return $result;
	}


	private static function create_detail_file($_store_id)
	{
		$dir = root . '/stores/detail/';
		if(!file_exists($dir))
		{
			\dash\file::makeDir($dir, null, true);
		}

		$dir .= $_store_id;

		$detail = \lib\db\store\get::detail($_store_id);

		$detail = json_encode($detail, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

		\dash\file::write($dir, $detail);

		return true;
	}


	private static function create_subdomain_file($_store_id, $_subdomain)
	{
		$dir = root . '/stores/subdomain/';
		if(!file_exists($dir))
		{
			\dash\file::makeDir($dir, null, true);
		}

		$dir .= $_subdomain;

		\dash\file::write($dir, $_store_id);

		return true;
	}
}
?>