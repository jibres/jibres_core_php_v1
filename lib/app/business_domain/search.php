<?php
namespace lib\app\business_domain;

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


	public static function my_business_list($_query_string, $_args)
	{
		if(!\lib\store::id())
		{
			return null;
		}

		$_args['my_list'] = true;
		$_args['store_id'] = \lib\store::id();

		return self::list($_query_string, $_args);
	}


	public static function list($_query_string, $_args)
	{
		$condition =
		[
			'order'              => 'order',
			'sort'               => ['enum' => ['name','id']],
			'store_id'           => 'id',
			'my_list'            => 'bit',

			'filter_status'      => ['enum' => ['ok','pending','failed']],
			'filter_addcdnpanel' => ['enum' => ['yes', 'no']],
			'filter_dns'         => ['enum' => ['resolved', 'notresolved']],
			'filter_https'       => ['enum' => ['request', 'requestok']],

			'ws'                 => 'y_n', // with subdomain
			'md'                 => 'y_n', // is master domain
			'rtmd'               => 'y_n', // redirect to master domain
			'hdid'               => 'y_n', // have domain id
			'cb'                 => 'y_n', // connect to business
			'checkdns'           => 'y_n',
			'dnsok'              => 'y_n',
			'cdnpanale'          => 'y_n',
			'httpsrequest'       => 'y_n',
			'httpsverify'        => 'y_n',
			'cdn'                => ['enum' => ['arvancloud', 'cloudflare', 'enterprise',]],
			'status'             => ['enum' => ['pending','failed','ok','pending_delete','deleted','inprogress','dns_not_resolved']],

		];



		$require = [];
		$meta    =	[];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);



		$and         = [];
		$meta        = [];
		$or          = [];
		$meta['join'] = [];

		$meta['limit'] = 20;


		$order_sort  = null;


		if($data['store_id'])
		{
			$and[] = " business_domain.store_id = $data[store_id] ";
		}



		if($data['my_list'])
		{
			$and[] = " business_domain.status NOT IN ('pending_delete', 'deleted') ";
		}


		if($data['filter_status'])
		{
			self::$is_filtered = true;
			self::$filter_args[T_("Status")] = T_($data['filter_status']);

			if($data['filter_status'] === 'ok')
			{
				$and[] = " business_domain.status = 'ok' ";
			}
			elseif($data['filter_status'] === 'pending')
			{
				$and[] = " business_domain.status = 'pending' ";
			}
			elseif($data['filter_status'] === 'failed')
			{
				$and[] = " business_domain.status = 'failed' ";
			}
		}

		if($data['status'])
		{
			$and[] = " business_domain.status = '$data[status]' ";
			self::$is_filtered = true;
		}

		if($data['cdn'])
		{
			$and[] = " business_domain.cdn = '$data[cdn]' ";
			self::$is_filtered = true;
		}


		if($data['filter_addcdnpanel'])
		{
			self::$is_filtered = true;

			if($data['filter_addcdnpanel'] === 'yes')
			{
				$and[] = " business_domain.cdnpanel IS NOT NULL ";
				self::$filter_args[T_("CDN panel")] = T_('Added');
			}
			elseif($data['filter_addcdnpanel'] === 'no')
			{
				$and[] = " business_domain.cdnpanel IS NULL ";
				self::$filter_args[T_("CDN panel")] = T_('Not added');
			}
		}


		if($data['filter_dns'])
		{
			self::$is_filtered = true;

			if($data['filter_dns'] === 'resolved')
			{
				$and[] = " business_domain.checkdns IS NOT NULL ";
				self::$filter_args[T_("DNS")] = T_('Resolved');

			}
			elseif($data['filter_dns'] === 'notresolved')
			{
				$and[] = " business_domain.checkdns IS NULL ";
				self::$filter_args[T_("DNS")] = T_('Not Resolved');
			}
		}


		if($data['filter_https'])
		{
			self::$is_filtered = true;

			if($data['filter_https'] === 'request')
			{
				$and[] = " business_domain.httpsrequest IS NOT NULL ";
				self::$filter_args[T_("HTTPS")] = T_('Request sended');
			}
			elseif($data['filter_https'] === 'requestok')
			{
				$and[] = " business_domain.httpsverify = 1 ";
				self::$filter_args[T_("HTTPS")] = T_('Ok');
			}
		}

		// with subdomain
		if($data['ws'] === 'y')
		{
			$and[] = " business_domain.subdomain IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['ws'] === 'n')
		{
			$and[] = " business_domain.subdomain IS NULL ";
			self::$is_filtered = true;
		}

		//is master domain
		if($data['md'] === 'y')
		{
			$and[] = " business_domain.master IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['md'] === 'n')
		{
			$and[] = " business_domain.master IS  NULL ";
			self::$is_filtered = true;
		}

		// redirect to master
		if($data['rtmd'] === 'y')
		{
			$and[] = " business_domain.redirecttomaster IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['rtmd'] === 'n')
		{
			$and[] = " business_domain.redirecttomaster IS NULL ";
			self::$is_filtered = true;
		}

		// have domain id
		if($data['hdid'] === 'y')
		{
			$and[] = " business_domain.domain_id IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['hdid'] === 'n')
		{
			$and[] = " business_domain.domain_id IS NULL ";
			self::$is_filtered = true;
		}

		if($data['cb'] === 'y')
		{
			$and[] = " business_domain.store_id IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['cb'] === 'n')
		{
			$and[] = " business_domain.store_id IS NULL ";
			self::$is_filtered = true;
		}

		if($data['checkdns'] === 'y')
		{
			$and[] = " business_domain.checkdns IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['checkdns'] === 'n')
		{
			$and[] = " business_domain.checkdns IS NULL ";
			self::$is_filtered = true;
		}

		if($data['dnsok'] === 'y')
		{
			$and[] = " business_domain.dnsok IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['dnsok'] === 'n')
		{
			$and[] = " business_domain.dnsok IS NULL ";
			self::$is_filtered = true;
		}

		if($data['cdnpanale'] === 'y')
		{
			$and[] = " business_domain.cdnpanale IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['cdnpanale'] === 'n')
		{
			$and[] = " business_domain.cdnpanale IS NULL ";
			self::$is_filtered = true;
		}

		if($data['httpsrequest'] === 'y')
		{
			$and[] = " business_domain.httpsrequest IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['httpsrequest'] === 'n')
		{
			$and[] = " business_domain.httpsrequest IS NULL ";
			self::$is_filtered = true;
		}

		if($data['httpsverify'] === 'y')
		{
			$and[] = " business_domain.httpsverify IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['httpsverify'] === 'n')
		{
			$and[] = " business_domain.httpsverify IS NULL ";
			self::$is_filtered = true;
		}



		$query_string = \dash\validate::search($_query_string, false);

		$meta['join'][] = " LEFT JOIN store_data ON store_data.id = business_domain.store_id ";
		$meta['join'][] = " LEFT JOIN users ON users.id = business_domain.user_id ";

		if($query_string)
		{
			$or[]        = " business_domain.domain LIKE '%$query_string%'";
			$or[]        = " store_data.title LIKE '%$query_string%'";
			$or[]        = " users.displayname LIKE '%$query_string%'";
			$or[]        = " users.mobile LIKE '%$query_string%'";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['id']))
			{

				$sort = mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY business_domain.id DESC";
		}



		$list = \lib\db\business_domain\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}


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
		$list = array_map(['\\lib\\app\\business_domain\\ready', 'row'], $list);

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

		return $list;
	}
}
?>