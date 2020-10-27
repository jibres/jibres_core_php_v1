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

		$condition =
		[
			'order'   => 'order',
			'sort'    => ['enum' => ['id']],
			'type'    => ['enum' => ['assistant', 'group', 'total', 'details']],
			'form_id' => 'id',
			'tag_id' => 'id',
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;
		// $meta['pagination'] = false;

		$order_sort  = null;

		if($data['tag_id'])
		{
			$meta['join'][] = " LEFT JOIN form_tagusage ON form_tagusage.answer_id = form_answer.id ";
			$and[] = " form_tagusage.form_tag_id = $data[tag_id] ";
			self::$is_filtered = true;

		}



		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$meta['join'][] = " LEFT JOIN form_answerdetail ON form_answerdetail.answer_id = form_answer.id ";

			$or[] = " form_answer.id LIKE '%$query_string%' ";
			$or[] = " form_answerdetail.answer LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}

		if($data['form_id'])
		{
			$and[] = " form_answer.form_id = $data[form_id] ";
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
			$order_sort = " ORDER BY form_answer.id ASC";
		}

		$list = \lib\db\form_answer\search::list($and, $or, $order_sort, $meta);


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