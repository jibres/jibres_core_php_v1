<?php
namespace lib\app\form\answer;


class add
{
	public static function new_answer($_args)
	{
		$condition =
		[
			'form_id' => 'id',
			'user_id' => 'id',
			'answer'  => 'bit', // just for skip clean error
		];


		$require = ['form_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$answer = isset($_args['answer']) ? $_args['answer'] : [];
		if(!is_array($answer))
		{
			$answer = [];
		}

		if(empty($answer))
		{
			\dash\notif::error(T_("Invalid answer"));
			return false;
		}

		$item_ids = array_keys($answer);
		$item_ids = array_map('floatval', $item_ids);
		$item_ids = array_filter($item_ids);
		$item_ids = array_unique($item_ids);
		if(!$item_ids)
		{
			\dash\notif::error(T_("Invalid item id"));
			return false;
		}

		$load_form = \lib\app\form\form\get::get($data['form_id']);
		if(!$load_form)
		{
			return false;
		}

		$check_true_item = \lib\db\form_item\get::item_id_form_id(implode(',', $item_ids), $data['form_id']);

		if(!$check_true_item || !is_array($check_true_item))
		{
			\dash\notif::error(T_("Invalid item id"));
			return false;
		}

		if(count($check_true_item) === count($item_ids))
		{
			// ok nothing
		}
		else
		{

			\dash\notif::error(T_("Some detail was wrong!"));
			return false;
		}

		$items = array_combine(array_column($check_true_item, 'id'), $check_true_item);

		foreach ($answer as $item_id => $my_answer)
		{
			if(!isset($items[$item_id]))
			{
				\dash\notif::error(T_("Invalid item id"));
				return false;
			}

			$item_detail = $items[$item_id];

			if(!isset($item_detail['type']))
			{
				\dash\notif::error(T_("Invalid type of item"));
				return false;
			}

			switch ($item_detail['type'])
			{
				case 'text':
					$my_answer = \dash\validate::string_200($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				default:
					\dash\notif::error(T_("Invalid item type"));
					return false;
					break;
			}
		}

		$add_answer_args =
		[
			'form_id'     => $data['form_id'],
			'user_id'     => $data['user_id'],
			'datecreated' => date("Y-m-d H:i:s"),
			'startdate'   => date("Y-m-d H:i:s"),
			'enddate'     => date("Y-m-d H:i:s"),
		];

		$add_answer = \lib\db\form_answer\insert::new_record($add_answer_args);

		if(!$add_answer)
		{
			\dash\log::oops('formAddAnswer');
			return false;
		}

		$insert_answerdetail = [];

		foreach ($answer as $item_id => $my_answer)
		{
			$insert_answerdetail[] =
			[
				'form_id'     => $data['form_id'],
				'user_id'     => $data['user_id'],
				'answer_id'   => $add_answer,
				'item_id'     => $item_id,
				'answer'      => $my_answer,
				'datecreated' => date("Y-m-d H:i:s"),
			];
		}


		$anwer_detail = \lib\db\form_answerdetail\insert::multi_insert($insert_answerdetail);

		\dash\notif::ok(T_("Your answer was saved"));
		return true;
	}
}
?>