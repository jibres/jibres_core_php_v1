<?php
namespace lib\app\nic_domain;

class search
{
	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;


	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list_admin($_query_string, $_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$_args['is_admin'] = true;

		return self::get_list($_query_string, $_args);

	}


	public static function list($_query_string, $_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$_args['user_id'] = \dash\user::id();

		return self::get_list($_query_string, $_args);
	}


	public static function count_user_domain($_user_id)
	{
		$args              = [];
		$args['user_id']   = $_user_id;
		$args['get_count'] = 1;
		return self::get_list(null, $args);
	}


	public static function get_list($_query_string, $_args)
	{

		$condition =
		[
			'order'           => 'order',
			'sort'            => 'string_100',
			'list'            => ['enum' => ['mydomain', 'renew', 'available', 'import']],
			'lock'            => ['enum' => ['on', 'off', 'unknown']],
			'autorenew'       => ['enum' => ['on', 'off']],
			'predict'         => 'bit',
			'status'          => 'string_100',
			'user_id'         => 'id',
			'is_admin'        => 'bit',
			'get_count'       => 'bit',
			'user'            => 'code',
			'autorenew_notif' => 'yes_no',
			'autorenew_mode'  => ['enum' => ['1week', '1month', '6month']],
			'pagination'      => 'y_n',

		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);



		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;

		if($data['pagination'] === 'n')
		{
			$meta['pagination'] = false;
		}


		$order_sort  = null;


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[]        = " domain.name LIKE '%$query_string%'";
			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(\lib\app\domains\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY domain.id DESC";
		}

		if($data['is_admin'])
		{
			// nothing
		}
		elseif($data['predict'])
		{
			if($data['autorenew_mode'])
			{
				$meta['pagination'] = false;
				$meta['fields'] =
				'
					domain.id AS `myid`,
					domain.name,
					domain.dateexpire,
					domain.autorenew,
					domain.renewnotif,
					domain.status,
					domain.user_id AS `owner`,
					domain.available,
					usersetting.domainlifetime,
					usersetting.autorenewperiod,
					usersetting.autorenewperiodcom
				';

				$meta['join'][] = "LEFT JOIN usersetting ON usersetting.user_id = domain.user_id ";

				switch ($data['autorenew_mode'])
				{
					case '1week':
						$and[]     = " usersetting.domainlifetime = '1week' ";
						$expire_at = date("Y-m-d", strtotime("+7 days"));

						break;

					case '1month':
						$and[]     = " usersetting.domainlifetime = '1month' ";
						$expire_at = date("Y-m-d", strtotime("+1 month"));
						break;

					case '6month':
						$and[]     = " usersetting.domainlifetime = '6month' ";
						$expire_at = date("Y-m-d", strtotime("+6 month"));
						break;

					default:
						$expire_at = date("Y-m-d", strtotime("+5 year"));
						break;
				}

				// only set notif
				if($data['autorenew_notif'] === 'yes')
				{
					$meta['limit'] = 100;
					$and[]         = " domain.renewnotif IS NULL ";
					$expire_at     = date("Y-m-d", strtotime($expire_at) + (60*60*24*1)); // + 1day to set notif
				}
				else
				{
					$and[] = " domain.renewnotif IS NOT NULL ";
					$and[] = " domain.renewtry IS NULL ";

					$meta['limit'] = 10;

				}
			}
			else
			{
				// get user setting of life time domain
				// if not set show 5 years
				$my_setting = \lib\app\nic_usersetting\get::get();

				if(isset($my_setting['domainlifetime']) && $my_setting['domainlifetime'])
				{
					$expire_at = date("Y-m-d", strtotime("+". $my_setting['domainlifetime']));
				}
				else
				{
					$expire_at = date("Y-m-d", strtotime("+5 year"));
				}
			}

			$and[]      = " DATE(domain.dateexpire) <= DATE('$expire_at') ";

			$order_sort = " ORDER BY domain.dateexpire ASC";
			$and[]      = " domain.status = 'enable' ";
			// $and[]   = " domain.verify = 1 ";
			$and[]      = " domain.autorenew = 1 ";
			$and[]      = " domain.available = 0 ";
			$and[] =
			"
				(
					SELECT
						domainstatus.status
					FROM
						domainstatus
					WHERE
						domainstatus.domain = domain.name AND
						domainstatus.active = 1 AND
						domainstatus.status IN
						(
							'serverRenewProhibited',
							'pendingDelete',
							'pendingRenew',
							'irnicRegistrationRejected',
							'irnicRegistrationPendingHolderCheck',
							'irnicRegistrationPendingDomainCheck',
							'irnicRegistrationDocRequired',
							'irnicRenewalPendingHolderCheck'
						)
					LIMIT 1
				) IS NULL ";
		}
		else
		{
			if($data['autorenew'] === 'on')
			{
				$and[] = " domain.autorenew = 1 ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Autorenew")] = T_("Active");

			}
			elseif($data['autorenew'] === 'off')
			{
				$and[] = " ( domain.autorenew IS NULL OR domain.autorenew = 0 ) ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Autorenew")] = T_("Deactive");
			}

			if($data['lock'] === 'on')
			{
				$and[] = " domain.lock = 1 ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Lock")] = T_("Active");
			}
			elseif($data['lock'] === 'off')
			{
				$and[] = " domain.lock = 0 ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Lock")] = T_("Deactive");
			}
			elseif($data['lock'] === 'unknown')
			{
				$and[] = " domain.lock IS NULL  ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Lock")] = T_("Unknown");
			}

			if(!$data['list'] || $data['list'] === 'mydomain')
			{
				$mobile = null;
				if(\dash\user::detail('verifymobile'))
				{
					$mobile = \dash\user::detail('mobile');
				}

				$emails = null;
				$have_emails = \dash\user::email_list(true);

				if($have_emails)
				{
					$emails = implode("','", $have_emails);
				}

				$mobile_emails_query = null;
				if($emails && $mobile)
				{
					$mobile_emails_query = " OR domain.mobile = '$mobile' OR domain.email IN ('$emails') ";
				}
				elseif($mobile)
				{
					$mobile_emails_query = " OR  domain.mobile = '$mobile' ";

				}
				elseif($emails)
				{
					$mobile_emails_query = " OR  domain.email IN ('$emails') ";
				}
				$and[] = " ( domain.available = 0 OR domain.available IS NULL) ";
				// $and[] = " domain.status = 'enable' ";
				$and[] = " ( domain.verify = 1  $mobile_emails_query )";
				// self::$is_filtered          = true;
				// self::$filter_args[T_("Status")] = T_("My domains");
			}
			elseif($data['list'] === 'renew')
			{
				// $and[] = " domain.status NOT IN ('deleted', 'enable') ";
				$and[] = " ( domain.verify = 0 OR domain.verify IS NULL ) AND ( domain.available = 0 OR domain.available IS NULL) AND (domain.gateway IS NULL OR domain.gateway != 'import') ";

				// self::$is_filtered          = true;
				// self::$filter_args[T_("Status")] = T_("Maybe for your");
			}
			elseif($data['list'] === 'available')
			{
				$and[] = " domain.available = 1 ";

				// self::$is_filtered          = true;
				// self::$filter_args[T_("Status")] = T_("Available");
			}
			elseif($data['list'] === 'import')
			{
				$and[] = " domain.gateway = 'import' AND ( domain.available = 0 OR domain.available IS NULL)AND ( domain.verify = 0 OR domain.verify IS NULL ) ";

				// self::$is_filtered          = true;
				// self::$filter_args[T_("Status")] = T_("Available");
			}
		}

		if($data['status'])
		{
			$and[] = " (SELECT domainstatus.status FROM domainstatus WHERE domainstatus.domain = domain.name and domainstatus.status = '$data[status]') IS NOT NULL ";
			$and[] = " domain.verify = 1 AND domain.available = 0 ";
		}

		$and[] = " domain.status != 'deleted' ";

		if($data['user_id'])
		{
			$and[] = " domain.user_id = $data[user_id] ";
		}

		if($data['user'])
		{
			$user_id = \dash\coding::decode($data['user']);
			if($user_id)
			{
				$and[] = " domain.user_id = $user_id ";
			}
		}

		if($data['get_count'])
		{
			$count = \lib\db\nic_domain\search::count_list($and, $or, $order_sort, $meta);
			return floatval($count);
		}
		else
		{
			$list = \lib\db\nic_domain\search::list($and, $or, $order_sort, $meta);
		}

		if($data['is_admin'])
		{
			$users_id = array_column($list, 'user_id');
			$users_id = array_filter($users_id);
			$users_id = array_unique($users_id);

			if($users_id)
			{
				$load_some_user = \dash\db\users\get::by_multi_id(implode(',', $users_id));
				if(is_array($load_some_user))
				{
					$load_some_user = array_combine(array_column($load_some_user, 'id'), $load_some_user);
					foreach ($list as $key => $value)
					{
						if(isset($value['user_id']) && $value['user_id'] && isset($load_some_user[$value['user_id']]))
						{
							$user_detail = $load_some_user[$value['user_id']];
							$user_detail = \dash\app\user::ready($user_detail);
							$list[$key]['user_detail'] = $user_detail;
						}
						else
						{
							$list[$key]['user_detail'] = [];
						}
					}
				}
			}
		}

		if(is_array($list))
		{
			// <div class="ibtn wide"><span>تمدید خودکار</span><i class="sf-refresh fc-blue"></i></div>
			$list = array_map(['\\lib\\app\\nic_domain\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}


		$filter_args_data = [];

		foreach (self::$filter_args as $key => $value)
		{
			if(isset($list[0][$key]) && substr($value, 0, 1) === '*')
			{
				$filter_args_data[substr($value, 1)] = $list[0][$key];
			}
			else
			{
				$filter_args_data[$key] = $value;
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);


		if($data['predict'] && !$data['autorenew_mode'])
		{
			$new_list = \lib\db\nic_domain\search::calc_pay_period_predict($and, $or, $order_sort, $meta);
			self::calc_pay_period_predict($new_list, $data['user_id']);
		}

		return $list;
	}

	private static function calc_pay_period_predict($_list, $_user_id)
	{
		$result          = [];
		$result['week']  = 0;
		$result['month'] = 0;
		$result['year']  = 0;
		$result['5year'] = 0;

		if(!is_array($_list))
		{
			$_list = [];
		}

		foreach ($_list as $key => $value)
		{
			if(isset($value['dateexpire']))
			{
				$dateexpire = strtotime($value['dateexpire']);
				if(!$dateexpire)
				{
					continue;
				}

				$time = time();
				$mytime = $dateexpire - $time;

				if($mytime < (60*60*24*7))
				{
					$result['week']++;
				}
				elseif($mytime < (60*60*24*30))
				{
					$result['month']++;
				}
				elseif($mytime < (60*60*24*365))
				{
					$result['year']++;
				}
			}
		}

		$get_setting = \lib\db\nic_usersetting\get::my_setting($_user_id);

		if(isset($get_setting['autorenewperiod']))
		{
			$autorenewperiod = $get_setting['autorenewperiod'];
		}
		else
		{
			$autorenewperiod = \lib\app\nic_usersetting\defaultval::autorenewperiod();
		}

		$price = \lib\app\nic_domain\price::renew($autorenewperiod);


		$return = [];

		$return[] = ['title' => T_("Pay in next week"), 'count' => $result['week'], 'price' => ($price * $result['week'])];
		$return[] = ['title' => T_("Pay in next month"), 'count' => $result['month'], 'price' => ($price * $result['month'])];
		$return[] = ['title' => T_("Pay in next year"), 'count' => $result['year'], 'price' => ($price * $result['year'])];



		\dash\data::myPayCalc($return);
	}



	public static function my_list()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$list = \lib\db\nic_domain\get::user_list(\dash\user::id());

		return $list;

	}

	public static function get_my_active_count($_user_id)
	{
		return self::get_list(null, ['user_id' => $_user_id, 'get_count' => true]);
	}


}
?>