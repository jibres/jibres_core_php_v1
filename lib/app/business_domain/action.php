<?php
namespace lib\app\business_domain;

class action
{

	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;

	public static function new_action($_id, $_action, $_args = [])
	{
		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args['datecreated']        = date("Y-m-d H:i:s");
		$_args['business_domain_id'] = $_id;
		$_args['action']             = $_action;
		$_args['user_id']            = \dash\user::jibres_user();
		$_args['gateway']            = \dash\temp::get('run:by:system') ? 'system' : 'user';

		return self::add($_args);
	}


	public static function add($_args)
	{
		\lib\db\business_domain\insert::new_record_action($_args);
	}


	public static function get_count($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$count = \lib\db\business_domain\get::action_count($id);

		return intval($count);
	}




	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}

	public static function domain_action_list($_id)
	{
		return self::list(null, ['id' => $_id]);
	}


	public static function list($_query_string, $_args)
	{
		$condition =
		[
			'order' => 'order',
			'sort'  => ['enum' => ['id']],
			'id'    => 'id',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);



		$and         = [];
		$meta        = [];
		$or          = [];
		$meta['join'] = [];

		$meta['limit'] = 20;


		$order_sort  = null;

		if($data['id'])
		{
			$and[] = " business_domain_action.business_domain_id = $data[id] ";
			self::$is_filtered = true;
		}


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);

		if($query_string)
		{
			// $or[]        = " users.mobile LIKE '%$query_string%'";
			// self::$is_filtered = true;
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
			$order_sort = " ORDER BY business_domain_action.id DESC";
		}


		$list = \lib\db\business_domain\search::list_action($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}


		$list = array_map(['self', 'ready'], $list);

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


	public static function ready($_data)
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
				case 'meta':

					if($value)
					{
						$value = json_decode($value, true);
					}

					$result[$key] = $value;
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