<?php
namespace lib\app\store;


class add
{

	public static function can($_get_detail = false, $_notif = true)
	{
		$user_id = \dash\user::id();

		// create new store by free plan
		// just check count of free plan store
		// check store count

		if(!\dash\permission::supervisor())
		{
			$count_store_free = intval(\lib\db\store\get::count_free_trial($user_id));

			// if($count_store_free >= 1)
			// {
			// 	$user_budget = \dash\db\transactions::budget($user_id, ['unit' => 'toman']);

			// 	$user_budget = floatval($user_budget);

			// 	if($user_budget < 10000)
			// 	{
			// 		$msg = T_("To register a second store, you need to have at least 10,000 toman in inventory on your account");
			// 		\dash\notif::code(1408);
			// 		if($_notif)
			// 		{
			// 			\dash\notif::error($msg);
			// 		}
			// 		if($_get_detail)
			// 		{
			// 			return ['can' => false, 'msg' => $msg, 'type' => 'price'];
			// 		}
			// 		else
			// 		{
			// 			return false;
			// 		}
			// 	}
			// }

			if($count_store_free >= 3)
			{
				$msg = T_("You can not have more than 3 free or trial stores."). ' '. T_("Contact Us if you need more stores");

				\dash\notif::code(1418);
				if($_notif)
				{
					\dash\notif::error($msg);
				}

				if($_get_detail)
				{
					return ['can' => false, 'msg' => $msg, 'type' => 'store3'];
				}
				else
				{
					return false;
				}
			}
		}

		if($_get_detail)
		{
			return ['can' => true];
		}
		return true;
	}


	public static function free($_args)
	{

		$condition =
		[
			'title'     => 'title',
			'subdomain' => 'subdomain',
			'answer'    => ['Q1' => 'smallint', 'Q2' => 'smallint', 'Q3' => 'smallint'],
		];

		$require = ['title', 'subdomain'];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$user_id = \dash\user::id();
		if(!$user_id)
		{
			\dash\notif::warn(T_("Please login to continue"));
			return false;
		}

		// check title
		$title     = $data['title'];
		$subdomain = $data['subdomain'];

		$check_exist = \lib\db\store\get::subdomain_exist($subdomain);
		if($check_exist)
		{
			\dash\notif::error(T_("This subdomain is already occupied"), 'subdomain');
			return false;
		}


		if(!self::can())
		{
			return false;
		}


		$args                = [];
		$args['owner']       = $user_id;
		$args['creator']     = $user_id;
		$args['title']       = $title;
		$args['subdomain']   = $subdomain;
		$args['startplan']   = date("Y-m-d H:i:s");
		$args['expireplan']  = null;
		$args['plan']        = 'free';

		// use in insert customer user table
		$args['mobile']      = \dash\user::detail('mobile');
		$args['displayname'] = \dash\user::detail('displayname');
		$args['gender']      = \dash\user::detail('gender');
		$args['avatar']      = \dash\user::detail('avatar');
		$args['birthday']    = \dash\user::detail('birthday');
		$args['marital']     = \dash\user::detail('marital');

		$args['fuel']        = \dash\engine\fuel::priority(\dash\url::tld());

		$fuel                = $args['fuel'];

		\dash\db::transaction();

		// add store record in jibres table
		$store_id = self::new_store($subdomain, $args['creator'], $fuel);

		if(!$store_id)
		{
			\dash\db::rollback();

			\dash\log::set('dbCanNotAddStore', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			\dash\notif::code(1428);

			return false;
		}

		// add store data in jibres database
		$add_store_data = self::new_store_data($args, $store_id);

		if(!$add_store_data)
		{
			\dash\db::rollback();

			\dash\log::set('dbCanNotAddStoreData', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			\dash\notif::code(1438);

			return false;
		}

		// add store plan in jibres database
		$add_store_plan = self::new_store_plan($args, $store_id);

		if(!$add_store_plan)
		{
			\dash\db::rollback();

			\dash\log::set('dbCanNotAddStorePlan', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			\dash\notif::code(1448);

			return false;
		}

		// add store user in jibres database
		$add_store_user = self::new_store_user($args, $store_id);

		if(!$add_store_user)
		{
			\dash\db::rollback();

			\dash\log::set('dbCanNotAddStoreUser', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			\dash\notif::code(1458);

			return false;
		}

		// create database of store customer
		$create_db = \lib\app\store\db::create($store_id, $args);

		if(!$create_db)
		{
			\dash\notif::error(T_("We can not create your store!"));

			\dash\log::set('createStoreDbOkCustormeDataBaseNOK', ['request_subdomain' => $subdomain, 'store_id' => $store_id]);

			\dash\notif::code(1468);

			return false;
		}

		\dash\db::commit();

		$create_detail_file = self::create_detail_file($store_id);

		$create_subdomain_file = self::create_subdomain_file($store_id, $subdomain);


		if(isset($_args['answer']) && is_array($_args['answer']))
		{
			self::new_store_analytics($_args['answer'], $store_id);
		}

		\dash\notif::ok(T_("Your store successfully created"), ['alerty' => true]);

		$log =
		[
			'my_name'      => $title,
			'my_subdomain' => $subdomain,
			'my_owner'     => $args['displayname'],
			'my_mobile'    => $args['mobile'],
			'my_gender'    => $args['gender'],
			'my_avatar'    => $args['avatar'],

		];

		\dash\log::set('business_createNew', $log);

		$result =
		[
			'store_id'  => $store_id,
			'subdomain' => $subdomain,
		];

		return $result;
	}


	private static function new_store($_subdomain, $_creator, $_fuel)
	{
		$new_store                = [];
		$new_store['subdomain']   = $_subdomain;
		$new_store['fuel']        = $_fuel;
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


	private static function new_store_analytics($_args, $_id)
	{
		$store_analytics                 = [];
		$store_analytics['id']           = $_id;
		$store_analytics['question1']    = (isset($_args['Q1']) && is_numeric($_args['Q1'])) ? $_args['Q1'] : null;
		$store_analytics['question2']    = (isset($_args['Q2']) && is_numeric($_args['Q2'])) ? $_args['Q2'] : null;
		$store_analytics['question3']    = (isset($_args['Q3']) && is_numeric($_args['Q3'])) ? $_args['Q3'] : null;
		$store_analytics['lastactivity'] = date("Y-m-d H:i:s");
		$store_analytics['datecreated']  = date("Y-m-d H:i:s");

		$result = \lib\db\store\insert::store_analytics($store_analytics);

		return $result;
	}


	private static function create_detail_file($_store_id)
	{
		$dir = \dash\engine\store::detail_addr();

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
		$dir = \dash\engine\store::subdomain_addr();

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