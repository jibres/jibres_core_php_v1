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
			'order'               => 'order',
			'sort'                => 'string_100',
			'list'                => ['enum' => ['mydomain', 'renew', 'available', 'import']],
			'lock'                => ['enum' => ['on', 'off', 'unknown']],
			'autorenew'           => ['enum' => ['on', 'off', 'default']],
			'reg'                 => ['enum' => ['com', 'ir']],
			'predict_until'       => ['enum' => ['week', 'month', 'year']],
			'expireat'            => ['enum' => ['week', 'month', 'year']],
			'expireatdate'        => 'date',
			'predict'             => 'bit',
			'get_total_predict'   => 'bit',
			'status'              => 'string_100',
			'user_id'             => 'id',
			'is_admin'            => 'bit',
			'get_count'           => 'bit',
			'user'                => 'code',
			'autorenew_notif'     => 'yes_no',
			'autorenew_adminlist' => 'yes_no',
			'autorenew_mode'      => 'bit',
			'pagination'          => 'y_n',

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

		if($data['reg'] === 'ir')
		{
			$and[] = " domain.registrar = 'irnic' ";
			self::$is_filtered = true;
		}
		elseif($data['reg'] === 'com')
		{
			$and[] = " domain.registrar != 'irnic' ";
			self::$is_filtered = true;
		}

		$is_com_domain = " domain.registrar != 'irnic' ";

		$not_prohibited_ir_status = "(".
		"
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

			)
			IS NULL	AND
			(
				SELECT
					domainstatus.status
				FROM
					domainstatus
				WHERE
					domainstatus.domain = domain.name AND
					domainstatus.active = 1 AND
					domainstatus.status = 'ok'
				LIMIT 1
			)
			IS NOT NULL
		";

		if($data['is_admin'])
		{
			// nothing
		}
		elseif($data['predict'])
		{
			$expire_at = date("Y-m-d", strtotime("+1 month"));

			// $meta['join'][] = "LEFT JOIN domainstatus ON domainstatus.domain = domain.name ";
			// $meta['fields'] = " DISTINCT domain.* ";
			if($data['autorenew_mode'])
			{

				$and[]      = " ( domain.autorenew = 1 OR ( domain.autorenew IS NULL AND usersetting.defaultautorenew = 1 )) ";
				$meta['pagination'] = false;
				$meta['fields'] =
				'
					domain.id AS `myid`,
					domain.name,
					domain.dateexpire,
					domain.autorenew,
					domain.renewnotif,
					domain.renewtry,
					domain.status,
					domain.user_id AS `owner`,
					domain.available,
					usersetting.autorenewperiod,
					usersetting.autorenewperiodcom
				';

				$meta['join'][] = "LEFT JOIN usersetting ON usersetting.user_id = domain.user_id ";

				$expire_at = date("Y-m-d", strtotime("+1 month"));

				// only set notif
				if($data['autorenew_notif'] === 'yes')
				{
					$meta['limit'] = 100;
					$and[]         = " domain.renewnotif IS NULL ";
					$expire_at     = date("Y-m-d", strtotime($expire_at) + (60*60*24*1)); // + 1day to set notif
				}
				else
				{
					if($data['autorenew_adminlist'] === 'yes')
					{
						// not check anything
						// big limit to show to admin
						$meta['limit'] = 100;
					}
					else
					{
						$yesterday = date("Y-m-d H:i:s", strtotime("-1 days"));
						$and[] = " domain.renewnotif IS NOT NULL AND domain.renewnotif < '$yesterday' ";
						$and[] = " domain.renewtry IS NULL ";
						$meta['limit'] = 10;
					}
				}
			}
			else
			{
				if($data['predict_until'])
				{
					$calc_pay_period_predict_expire_at  = " DATE(domain.dateexpire) <= DATE('$expire_at') ";
					if($data['predict_until'] === 'week')
					{
						$next_week = date("Y-m-d", strtotime("+7 days"));
						if(strtotime($expire_at) > strtotime($next_week))
						{
							$expire_at = $next_week;
						}
					}
					elseif($data['predict_until'] === 'month')
					{
						$next_month = date("Y-m-d", strtotime("+30 days"));
						if(strtotime($expire_at) > strtotime($next_month))
						{
							$expire_at = $next_month;
						}
					}
					elseif($data['predict_until'] === 'year')
					{
						// nothing
					}
				}
			}

			$and['predict_expire_at']      = " DATE(domain.dateexpire) <= DATE('$expire_at') ";

			$order_sort = " ORDER BY domain.dateexpire ASC";
			$and[]      = " domain.status = 'enable' ";

			$and[]      = " domain.available = 0 ";

			$and['domain_status_expire_checker'] = " (($not_prohibited_ir_status) OR ($is_com_domain)) ";

		}
		else
		{
			$mobile = null;
			if($data['user_id'])
			{
				$user_detail = \dash\db\users::get_by_id($data['user_id']);
				if(isset($user_detail['mobile']))
				{
					$mobile = $user_detail['mobile'];
				}
			}
			else
			{
				if(\dash\user::detail('verifymobile'))
				{
					$mobile = \dash\user::detail('mobile');
				}
			}

			$emails = null;
			$have_emails = self::get_email_list($data['user_id']);

			if($have_emails)
			{
				$emails = implode("','", $have_emails);
			}

			$mobile_emails_query     = null;
			$mobile_emails_not_query = null;

			if($emails && $mobile)
			{
				$mobile_emails_query = " OR domain.mobile = '$mobile' OR domain.email IN ('$emails') OR domain.email_tech IN ('$emails') ";
				$mobile_emails_not_query = " ( (domain.mobile IS NULL OR domain.mobile != '$mobile') AND (domain.email IS NULL OR domain.email NOT IN ('$emails')) AND (domain.email_tech IS NULL OR domain.email_tech NOT IN ('$emails')) ) ";
			}
			elseif($mobile)
			{
				$mobile_emails_query = " OR  domain.mobile = '$mobile' ";
				$mobile_emails_not_query = "  (domain.mobile IS NULL OR domain.mobile != '$mobile') ";

			}
			elseif($emails)
			{
				$mobile_emails_query = " OR  domain.email IN ('$emails') OR domain.email_tech IN ('$emails') ";
				$mobile_emails_not_query = "  (domain.email IS NULL OR  domain.email NOT IN ('$emails')) AND (domain.email_tech IS NULL OR  domain.email_tech NOT IN ('$emails')) ";
			}


			if(!$data['list'] || $data['list'] === 'mydomain')
			{
				$and[] = " ( domain.available = 0 OR domain.available IS NULL) ";
				$and[] = " ( domain.verify = 1  $mobile_emails_query )";

			}
			elseif($data['list'] === 'renew')
			{
				$and[] = " ( domain.verify = 0 OR domain.verify IS NULL ) AND ( domain.available = 0 OR domain.available IS NULL) AND (domain.gateway IS NULL OR domain.gateway != 'import') ";
				$and[] = " $mobile_emails_not_query ";
			}
			elseif($data['list'] === 'available')
			{
				$and[] = " domain.available = 1 ";
			}
			elseif($data['list'] === 'import')
			{
				$and[] = " domain.gateway = 'import' AND ( domain.available = 0 OR domain.available IS NULL)AND ( domain.verify = 0 OR domain.verify IS NULL ) ";
				$and[] = " $mobile_emails_not_query ";
			}
		}

		if($data['expireat'])
		{
			$now = date("Y-m-d H:i:s");

			$and['domain_status_expire_checker'] = " (($not_prohibited_ir_status) OR ($is_com_domain)) ";
			switch ($data['expireat'])
			{
				case 'week':
					$expire_at = date("Y-m-d", strtotime("+7 days"));
					$and[]      = " DATE(domain.dateexpire) <= DATE('$expire_at') ";
					$and[]      = " domain.dateexpire >= '$now' ";
					self::$is_filtered          = true;
					break;

				case 'month':
					$expire_at = date("Y-m-d", strtotime("+30 days"));
					$and[]      = " DATE(domain.dateexpire) <= DATE('$expire_at') ";
					$and[]      = " domain.dateexpire >= '$now' ";
					self::$is_filtered          = true;
					break;

				case 'year':
					$expire_at = date("Y-m-d", strtotime("+365 days"));
					$and[]      = " DATE(domain.dateexpire) <= DATE('$expire_at') ";
					$and[]      = " domain.dateexpire >= '$now' ";
					self::$is_filtered          = true;
					break;

				default:
					// nothing
					break;
			}
		}

		if($data['expireatdate'])
		{
			$and['domain_status_expire_checker'] = " (($not_prohibited_ir_status) OR ($is_com_domain)) ";
			$and[] = " DATE(domain.dateexpire) = DATE('$data[expireatdate]') ";
		}


		if($data['autorenew'] === 'on')
		{
			$and[]      = " ( domain.autorenew = 1 OR ( domain.autorenew IS NULL AND usersetting.defaultautorenew = 1 )) ";
			$meta['join'][] = "LEFT JOIN usersetting ON usersetting.user_id = domain.user_id ";
			self::$is_filtered          = true;

		}
		elseif($data['autorenew'] === 'off')
		{
			$and[]      = " ( domain.autorenew = 0 OR ( domain.autorenew IS NULL AND usersetting.defaultautorenew = 0 )) ";
			$meta['join'][] = "LEFT JOIN usersetting ON usersetting.user_id = domain.user_id ";
			self::$is_filtered          = true;
		}
		elseif($data['autorenew'] === 'default')
		{
			$and[] = " domain.autorenew IS NULL  ";
			self::$is_filtered          = true;
		}

		if($data['lock'] === 'on')
		{
			$and[] = " domain.lock = 1 ";
			self::$is_filtered          = true;
		}
		elseif($data['lock'] === 'off')
		{
			$and[] = " domain.lock = 0 ";
			self::$is_filtered          = true;
		}
		elseif($data['lock'] === 'unknown')
		{
			$and[] = " domain.lock IS NULL  ";
			self::$is_filtered          = true;
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

		$list = [];

		if($data['get_count'])
		{
			$count = \lib\db\nic_domain\search::count_list($and, $or, $order_sort, $meta);
			return floatval($count);
		}
		elseif($data['get_total_predict'])
		{
			// no get list of preditct
		}
		else
		{
			$list = \lib\db\nic_domain\search::list($and, $or, $order_sort, $meta);
		}

		if($list)
		{
			self::need_verify_email($list, $data['user_id']);
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

		if(is_array($list) && $list)
		{
			// <div class="ibtn wide"><span>تمدید خودکار</span><i class="sf-refresh fc-blue"></i></div>
			$list = array_map(['\\lib\\app\\nic_domain\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}


		if($data['predict'] && !$data['autorenew_mode'])
		{
			if(isset($calc_pay_period_predict_expire_at))
			{
				unset($and['predict_expire_at']);
				$and[] = $calc_pay_period_predict_expire_at;
			}

			$new_list = \lib\db\nic_domain\search::calc_pay_period_predict($and, $or, $order_sort, $meta);
			$price_list = self::calc_pay_period_predict($new_list, $data['user_id']);
			foreach ($price_list as $key => $value)
			{
				foreach ($list as $k => $v)
				{
					if(isset($v['name']) && isset($value['name']) && $v['name'] == $value['name'] && isset($value['price']))
					{
						$list[$k]['renew_price'] = $value['price'];
					}
				}
			}

		}
		return $list;
	}



	/**
	 * Get email list
	 *
	 * @var        boolean
	 */
	private static $my_email_list = false;


	private static function get_email_list($_user_id)
	{
		if(self::$my_email_list === false)
		{
			self::$my_email_list = \dash\user::email_list(true, false, $_user_id);
		}

		if(!is_array(self::$my_email_list))
		{
			self::$my_email_list = [];
		}

		return self::$my_email_list;
	}


	private static function need_verify_email($list, $_user_id)
	{
		$all_email = array_column($list, 'email');
		$all_email_tech = array_column($list, 'email_tech');

		$all_email = array_merge($all_email, $all_email_tech);
		$all_email = array_unique($all_email);
		$all_email = array_filter($all_email);

		if(!$all_email)
		{
			return;
		}

		$current_email = self::get_email_list($_user_id);

		$new_email = array_diff($all_email, $current_email);

		\dash\data::needVerifyEmail($new_email);

	}

	private static function calc_pay_period_predict($_list, $_user_id)
	{
		$result                = [];
		$result['week']        = 0;
		$result['month']       = 0;
		$result['year']        = 0;

		$result['week_count']  = 0;
		$result['month_count'] = 0;
		$result['year_count']  = 0;

		$result['5year']       = 0;

		if(!is_array($_list))
		{
			$_list = [];
		}

		$get_setting = \lib\db\nic_usersetting\get::my_setting($_user_id);

		if(isset($get_setting['autorenewperiod']) && $get_setting['autorenewperiod'])
		{
			$autorenewperiod = $get_setting['autorenewperiod'];
		}
		else
		{
			$autorenewperiod = \lib\app\nic_usersetting\defaultval::autorenewperiod();
		}



		if(isset($get_setting['autorenewperiodcom']) && $get_setting['autorenewperiodcom'])
		{
			$autorenewperiodcom = $get_setting['autorenewperiodcom'];
		}
		else
		{
			$autorenewperiodcom = '1year';
		}

		foreach ($_list as $key => $value)
		{
			if(a($value, 'registrar') === 'irnic')
			{
				$_list[$key]['price'] = \lib\app\nic_domain\price::renew($autorenewperiod);
			}
			else
			{
				$tld   = explode('.', a($value, 'name'));
				$tld   = end($tld);
				$price = \lib\app\onlinenic\price::quick_renew($tld, substr($autorenewperiodcom, 0, 1));

				$_list[$key]['price'] = $price;

			}

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
					$result['week_count']++;
					$result['week'] += floatval(a($_list, $key, 'price'));
				}

				if($mytime < (60*60*24*30))
				{
					$result['month_count']++;
					$result['month'] += floatval(a($_list, $key, 'price'));
				}

				if($mytime < (60*60*24*365))
				{
					$result['year_count']++;
					$result['year']+= floatval(a($_list, $key, 'price'));
				}
			}

		}

		$return = [];

		$return[] = ['key' => 'week', 'title' => T_("Pay in next week"), 'price' => $result['week'], 'count' => $result['week_count']];
		$return[] = ['key' => 'month', 'title' => T_("Pay in next month"), 'price' => $result['month'], 'count' => $result['month_count']];
		$return[] = ['key' => 'year', 'title' => T_("Pay in next year"), 'price' => $result['year'], 'count' => $result['year_count']];

		\dash\data::myPayCalc($return);

		return $_list;
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

	public static function get_my_active_count($_user_id, $_args = [])
	{
		return self::get_list(null, array_merge($_args, ['user_id' => $_user_id, 'get_count' => true]));
	}


}
?>