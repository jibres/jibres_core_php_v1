<?php
namespace lib\app\form\answerdetail;


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


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['title', 'id']],
			'type'      => ['enum' => ['assistant', 'group', 'total', 'details']],
			'answer_id' => 'id',
			'form_id'   => 'id',
			'item_id'   => 'id',
			'export'    => 'bit',
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 50;
		if($data['export'])
		{
			$meta['limit'] = 500;
		}

		$order_sort  = null;

		if($data['answer_id'])
		{
			$and[] = " form_answerdetail.answer_id = $data[answer_id] ";
		}

		if($data['form_id'])
		{
			$and[] = " form_answerdetail.form_id = $data[form_id] ";
		}

		if($data['item_id'])
		{
			$and[] = " form_answerdetail.item_id = $data[item_id] ";
		}

		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);

		if($query_string)
		{
			$or[] = " form_answerdetail.answer LIKE '%$query_string%' ";
			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['datecreated']))
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
			$order_sort = " ORDER BY form_answerdetail.id ASC";
		}

		$list = \lib\db\form_answerdetail\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\form\\answer\\ready', 'row'], $list);

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