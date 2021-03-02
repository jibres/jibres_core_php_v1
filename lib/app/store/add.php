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

			$businessMaxLimit = \dash\app\user\business::businesscount($user_id);

			if($count_store_free >= $businessMaxLimit)
			{
				$msg = T_("You can not have more than :val free or trial stores.", ['val' => \dash\fit::number($businessMaxLimit)]). ' '. T_("Contact Us if you need more stores");

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
			'answer'    => 'bit', // needless to check answer. the answer was saved before
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

		if(substr_count($title, ' ') > 8)
		{
			\dash\notif::error(T_("You can use less than 8 space character in business name"));
			return false;
		}

		$subdomain = $data['subdomain'];

		$check_exist = \lib\db\store\get::subdomain_exist($subdomain);
		if($check_exist)
		{
			\dash\temp::set('subdomain_exist_in_creating_store', true);

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

		\dash\log::set('StartMakeNewStore', ['my_detail' => $args]);


		// add store record in jibres table
		$store_id = self::new_store($subdomain, $args['creator'], $fuel);

		if(!$store_id)
		{
			\dash\log::set('dbCanNotAddStore', ['request_subdomain' => $subdomain]);

			\dash\notif::error(T_("Can not add your store"));

			\dash\notif::code(1428);

			return false;
		}

		\dash\db::transaction();

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

		// // add store plan in jibres database
		// $add_store_plan = self::new_store_plan($args, $store_id);

		// if(!$add_store_plan)
		// {
		// 	\dash\db::rollback();

		// 	\dash\log::set('dbCanNotAddStorePlan', ['request_subdomain' => $subdomain]);

		// 	\dash\notif::error(T_("Can not add your store"));

		// 	\dash\notif::code(1448);

		// 	return false;
		// }

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
		$new_store['ip']          = \dash\server::iplong();
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
		$new_store_data['logo']          = null;
		$new_store_data['lastactivity']  = date("Y-m-d H:i:s");
		$new_store_data['dbversion']     = null;
		$new_store_data['dbversiondate'] = null;
		$new_store_data['datecreated']   = date("Y-m-d H:i:s");;

		$result = \lib\db\store\insert::store_data($new_store_data);

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

		if(a($_args, 'Q1'))
		{
			$Q1 = $_args['Q1'];
			$Q1 = \dash\validate::smallint($Q1, false);
			if($Q1)
			{
				$store_analytics['question1'] = $Q1;
			}
		}

		if(a($_args, 'Q2'))
		{
			$Q2 = $_args['Q2'];
			$Q2 = \dash\validate::smallint($Q2, false);
			if($Q2)
			{
				$store_analytics['question2'] = $Q2;
			}
		}

		if(a($_args, 'Q3'))
		{
			$Q3 = $_args['Q3'];
			$Q3 = \dash\validate::smallint($Q3, false);
			if($Q3)
			{
				$store_analytics['question3'] = $Q3;
			}
		}


		$store_analytics['lastactivity'] = date("Y-m-d H:i:s");
		$store_analytics['datecreated']  = date("Y-m-d H:i:s");


		$result = \lib\db\store\insert::store_analytics($store_analytics);

		$store_timeline = [];
		$store_timeline['store_id'] = $_id;

		if(a($_args, 'st1'))
		{
			$st1 = $_args['st1'];
			$st1 = \dash\validate::bigint($st1, false);
			if($st1)
			{
				$st1 = date("Y-m-d H:i:s", $st1);
				if($st1)
				{
					$store_timeline['start'] = $st1;
				}
			}
		}


		if(a($_args, 'st2'))
		{
			$st2 = $_args['st2'];
			$st2 = \dash\validate::bigint($st2, false);
			if($st2)
			{
				$st2 = date("Y-m-d H:i:s", $st2);
				if($st2)
				{
					$store_timeline['ask'] = $st2;
				}
			}
		}


		if(a($_args, 'st3'))
		{
			$st3 = $_args['st3'];
			$st3 = \dash\validate::bigint($st3, false);
			if($st3)
			{
				$st3 = date("Y-m-d H:i:s", $st3);
				if($st3)
				{
					$store_timeline['subdomain'] = $st3;
				}
			}
		}

		if(a($_args, 'st4'))
		{
			$st4 = $_args['st4'];
			$st4 = \dash\validate::bigint($st4, false);
			if($st4)
			{
				$st4 = date("Y-m-d H:i:s", $st4);
				if($st4)
				{
					$store_timeline['startcreate'] = $st4;
				}
			}
		}

		$store_timeline['endcreate'] = date("Y-m-d H:i:s");
		$result = \lib\db\store\insert::store_timeline($store_timeline);


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