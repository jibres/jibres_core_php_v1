<?php
namespace lib\app\form\answer;


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
		\dash\permission::access('_group_form');

		$condition =
		[
			'order'       => 'order',
			'sort'        => ['enum' => ['id', 'datecreated']],
			'type'        => ['enum' => ['assistant', 'group', 'total', 'details']],
			'status'      => ['enum' => ['draft','active','spam', 'archive', 'deleted']],
			'form_id'     => 'id',
			'tag_id'      => 'id',
			'start_date'  => 'date',
			'end_date'    => 'date',
			'not_deleted' => 'bit',
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$param = [];
		$and   = [];
		$meta  = [];
		$or    = [];

		$meta['limit'] = 20;
		// $meta['pagination'] = false;

		$order_sort  = null;

		if($data['tag_id'])
		{
			$meta['join'][] = " LEFT JOIN form_tagusage ON form_tagusage.answer_id = form_answer.id ";
			$and[] = " form_tagusage.form_tag_id = :tag_id ";
			$param[':tag_id'] = $data['tag_id'];
			self::$is_filtered = true;

		}

		if($data['not_deleted'])
		{
			$and['not_deleted'] = " (form_answer.status IS NULL OR form_answer.status != 'deleted') ";
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$meta['join'][] = " LEFT JOIN form_answerdetail ON form_answerdetail.answer_id = form_answer.id ";

			$or[] = " form_answer.id LIKE :serch_string1 ";
			$or[] = " form_answerdetail.answer LIKE :serch_string2 ";

			$param[':serch_string1'] = '%'. $query_string. '%';
			$param[':serch_string2'] = '%'. $query_string. '%';

			self::$is_filtered = true;
		}

		if($data['form_id'])
		{
			$and[] = " form_answer.form_id = :form_id ";
			$param[':form_id'] = $data['form_id'];
		}

		if($data['status'])
		{
			$and[]           = " form_answer.status = :status ";
			$param[':status'] = $data['status'];
			unset($and['not_deleted']);
			self::$is_filtered = true;

		}

		if($data['start_date'])
		{
			$and[]           = " form_answer.datecreated >= :start_date ";
			$param[':start_date'] = $data['start_date']. ' 00:00:00';
			self::$is_filtered = true;

		}


		if($data['end_date'])
		{
			$and[]           = " form_answer.datecreated <= :end_date ";
			$param[':end_date'] = $data['end_date']. ' 23:59:59';
			self::$is_filtered = true;

		}



		$check_order_trust = \lib\app\form\answer\filter::check_allow($data['sort'], $data['order']);

		if($check_order_trust)
		{
			$sort = \dash\str::mb_strtolower($data['sort']);
			if($data['order'])
			{
				$order = \dash\str::mb_strtolower($data['order']);
			}

			$order_sort = " ORDER BY $sort $order";
		}


		if(!$order_sort)
		{
			$order_sort = " ORDER BY form_answer.id DESC";
		}

		$list = \lib\db\form_answer\search::list($param, $and, $or, $order_sort, $meta);


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