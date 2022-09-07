<?php
namespace lib\app\sms;

class search
{

	private static $is_filtered = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{
		$condition =
			[
				'order'        => 'order',
				'sort'         => 'string_100',
				'store_id'     => 'id',
				'status'       => [
					'enum' => [
						'pending', 'sending', 'send', 'expired', 'delivered', 'queue', 'failed', 'undelivered',
						'cancel', 'block', 'other', 'moneylow',
					],
				],
				// 'type'      => ['enum' => []],
				'mobile'       => 'mobile',
				'conversation' => 'bit',
				'notsend'    => 'bit',
			];


		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and          = [];
		$meta         = [];
		$or           = [];
		$meta['join'] = [];

		$meta['limit'] = 20;


		$order_sort = null;


		if($data['store_id'])
		{
			$and[] = " sms_log.store_id = $data[store_id] ";
		}

		if($data['mobile'])
		{
			$and[]             = " sms_log.mobile = '$data[mobile]' ";
			self::$is_filtered = true;
		}

		if($data['status'])
		{
			if($data['status'] === 'other')
			{
				$and[] = " sms_log.status NOT IN ('pending', 'sending', 'send') ";

			}
			else
			{
				$and[] = " sms_log.status = '$data[status]' ";
			}
			self::$is_filtered = true;
		}

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$mobile = \dash\validate::mobile($query_string, false);
			if($mobile)
			{
				$or[] = " sms_log.mobile = '$mobile'";
			}
			else
			{
				$or[] = " sms_log.mobile LIKE '%$query_string%'";
			}
			self::$is_filtered = true;
		}

		if($data['notsend'])
		{
			$and               = [];
			$or                = [];
			$and[]             = " sms_log.status IN('pending', 'register') AND sms_log.jibres_sms_id IS NULL ";
			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(\lib\app\sms\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY sms_log.id DESC";
		}


		if($data['conversation'])
		{
			$list = \lib\db\sms_log\search::conversation_list($and, $or, $order_sort, $meta);

		}
		else
		{
			$list = \lib\db\sms_log\search::list($and, $or, $order_sort, $meta);
		}

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
						$user_detail               = $load_some_user[$value['user_id']];
						$user_detail               = \dash\app\user::ready($user_detail);
						$list[$key]['user_detail'] = $user_detail;
					}
					else
					{
						$list[$key]['user_detail'] = [];
					}
				}
			}
		}

		$list = array_map(['\\lib\\app\\sms\\ready', 'row'], $list);

		return $list;
	}


	public static function jibres_list($_query_string, $_args)
	{
		$condition =
			[
				'order'    => 'order',
				'sort'     => 'string_100',
				'store_id' => 'id',
				'status'   => [
					'enum' => [
						'pending', 'sending', 'send', 'delivered', 'queue', 'failed', 'undelivered', 'cancel', 'block',
						'other',
					],
				],
				// 'type'      => ['enum' => []],
				'mobile'   => 'mobile',
			];


		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and          = [];
		$meta         = [];
		$or           = [];
		$meta['join'] = [];

		$meta['limit'] = 20;


		$order_sort = null;


		if($data['store_id'])
		{
			$and[] = " sms.store_id = $data[store_id] ";
		}

		if($data['mobile'])
		{
			$and[]             = " sms.mobile = '$data[mobile]' ";
			self::$is_filtered = true;
		}

		if($data['status'])
		{
			if($data['status'] === 'other')
			{
				$and[] = " sms.status NOT IN ('pending', 'sending', 'send') ";

			}
			else
			{
				$and[] = " sms.status = '$data[status]' ";
			}
			self::$is_filtered = true;
		}

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$mobile = \dash\validate::mobile($query_string, false);
			if($mobile)
			{
				$or[] = " sms.mobile = '$mobile'";
			}
			else
			{
				$or[] = " sms.mobile LIKE '%$query_string%'";
			}
			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(\lib\app\sms\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY sms.id DESC";
		}

		$list = \lib\db\sms\search::list($and, $or, $order_sort, $meta);


		if(!is_array($list))
		{
			$list = [];
		}


		$list = array_map(['\\lib\\app\\sms\\ready', 'row'], $list);

		return $list;
	}


	public static function sms_sending_list($_query_string, $_args)
	{
		$condition =
			[
				'order'    => 'order',
				'sort'     => 'string_100',
				'store_id' => 'id',
				'status'   => [
					'enum' => [
						'pending', 'sending', 'send', 'delivered', 'queue', 'failed', 'undelivered', 'cancel', 'block',
						'other',
					],
				],
				// 'type'      => ['enum' => []],
				'mobile'   => 'mobile',
			];


		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and          = [];
		$meta         = [];
		$or           = [];
		$meta['join'] = [];

		$meta['limit'] = 20;


		$order_sort = " ORDER BY id DESC";


		$list = \lib\db\sms\search::sms_sending_list($and, $or, $order_sort, $meta);


		if(!is_array($list))
		{
			$list = [];
		}


		return $list;
	}

}

?>