<?php
namespace lib\app\business_domain;

class search_dns
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



	public static function list($_query_string, $_args)
	{
		$condition =
		[
			'order'       => 'order',
			'sort'        => ['enum' => ['name','id']],
			'filter_status'      => ['enum' => ['ok','pending','failed']],
			'filter_addcdnpanel' => ['enum' => ['yes', 'no']],
			'filter_dns'         => ['enum' => ['resolved', 'notresolved']],
			'filter_https'       => ['enum' => ['request', 'requestok']],
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



		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		if($data['filter_status'])
		{
			self::$is_filtered = true;
			self::$filter_args[T_("Status")] = T_($data['filter_status']);

			if($data['filter_status'] === 'ok')
			{
				$and[] = " business_domain_dns.status = 'ok' ";
			}
			elseif($data['filter_status'] === 'pending')
			{
				$and[] = " business_domain_dns.status = 'pending' ";
			}
			elseif($data['filter_status'] === 'failed')
			{
				$and[] = " business_domain_dns.status = 'failed' ";
			}
		}


		if($data['filter_addcdnpanel'])
		{
			self::$is_filtered = true;

			if($data['filter_addcdnpanel'] === 'yes')
			{
				$and[] = " business_domain_dns.cdnpanel IS NOT NULL ";
				self::$filter_args[T_("CDN panel")] = T_('Added');
			}
			elseif($data['filter_addcdnpanel'] === 'no')
			{
				$and[] = " business_domain_dns.cdnpanel IS NULL ";
				self::$filter_args[T_("CDN panel")] = T_('Not added');
			}
		}


		if($data['filter_dns'])
		{
			self::$is_filtered = true;

			if($data['filter_dns'] === 'resolved')
			{
				$and[] = " business_domain_dns.checkdns IS NOT NULL ";
				self::$filter_args[T_("DNS")] = T_('Resolved');

			}
			elseif($data['filter_dns'] === 'notresolved')
			{
				$and[] = " business_domain_dns.checkdns IS NULL ";
				self::$filter_args[T_("DNS")] = T_('Not Resolved');
			}
		}


		if($data['filter_https'])
		{
			self::$is_filtered = true;

			if($data['filter_https'] === 'request')
			{
				$and[] = " business_domain_dns.httpsrequest IS NOT NULL ";
				self::$filter_args[T_("HTTPS")] = T_('Request sended');
			}
			elseif($data['filter_https'] === 'requestok')
			{
				$and[] = " business_domain_dns.httpsverify = 1 ";
				self::$filter_args[T_("HTTPS")] = T_('Ok');
			}
		}


		$query_string = \dash\validate::search($_query_string);

		$meta['join'][] = " LEFT JOIN business_domain ON business_domain.id = business_domain_dns.business_domain_id ";


		if($query_string)
		{


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
			$order_sort = " ORDER BY business_domain_dns.id DESC";
		}



		$list = \lib\db\business_domain\search::list_dns($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}


		$list = array_map(['\\lib\\app\\business_domain\\dns', 'ready'], $list);

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