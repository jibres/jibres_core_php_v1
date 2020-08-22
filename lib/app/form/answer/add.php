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


		$multiple_choice_answer = [];

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

		$check_true_item = array_map(['\\lib\\app\\form\\item\\ready', 'row'], $check_true_item);

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


			$type              = $item_detail['type'];
			$check_unique_args = [];
			$maxlen            = null;
			$min               = 0;
			$max               = 99999999999999;

			if(isset($item_detail['maxlen']) && is_numeric($item_detail['maxlen']) && floatval($item_detail['maxlen']) < 200)
			{
				$maxlen = floatval($item_detail['maxlen']);
			}

			if(isset($item_detail['setting'][$type]['min']) && is_numeric($item_detail['setting'][$type]['min']))
			{
				$min = floatval($item_detail['setting'][$type]['min']);
			}

			if(isset($item_detail['setting'][$type]['max']) && is_numeric($item_detail['setting'][$type]['max']) && floatval($item_detail['setting'][$type]['max']) < $max)
			{
				$max = floatval($item_detail['setting'][$type]['max']);
			}


			$check_unique = false;
			if(isset($item_detail['setting'][$type]['check_unique']) && $item_detail['setting'][$type]['check_unique'])
			{
				$check_unique = true;
			}



			if(isset($item_detail['require']) && $item_detail['require'])
			{
				if(!$my_answer && $my_answer !== '0')
				{
					\dash\notif::error(T_(":val is required", ['val' => \dash\get::index($item_detail, 'title')]));
					return false;
				}
			}

			switch ($type)
			{

				case 'short_answer':
					if(!$maxlen)
					{
						$maxlen = 200;
					}

					$fn               = 'string_'. $maxlen;
					$my_answer        = \dash\validate::$fn($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'descriptive_answer':
					if(!$maxlen)
					{
						$fn = 'desc';
					}
					else
					{
						$fn = 'string_'. $maxlen;
					}

					$my_answer         = \dash\validate::$fn($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				// case 'descriptive_after_short_answer':
				// 	$my_answer         = \dash\validate::string_100($my_answer);
				// 	$answer[$item_id] = $my_answer;
				// 	break;

				case 'numeric':
					$my_answer         = \dash\validate::number($my_answer, true, ['min' => $min, 'max' => $max]);
					$answer[$item_id] = $my_answer;
					break;

				case 'single_choice':
					$my_answer         = \dash\validate::string_100($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'multiple_choice':
					if(!is_array($my_answer))
					{
						$my_answer = [];
					}

					foreach ($my_answer as $k => $v)
					{
						$multiple_choice_answer[] = \dash\validate::string_200($v);
					}

					$answer[$item_id] = $multiple_choice_answer;
					break;

				case 'dropdown':
					$my_answer = \dash\validate::string_200($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'date':
					$my_answer = \dash\validate::date($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'birthdate':
					$my_answer = \dash\validate::birthdate($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'country':
					$my_answer = \dash\validate::country($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'province':
					$my_answer = \dash\validate::province($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'city':
					$my_answer = \dash\validate::city($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'gender':
					$my_answer = \dash\validate::enum($my_answer, true, ['enum' => ['male', 'female']]);
					$answer[$item_id] = $my_answer;
					break;

				case 'time':
					$my_answer = \dash\validate::time($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'tel':
					$my_answer = \dash\validate::phone($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'file':
					$my_answer = \dash\validate::string_100($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'nationalcode':
					$my_answer = \dash\validate::nationalcode($my_answer);
					$answer[$item_id] = $my_answer;

					if($check_unique)
					{
						$check_unique_args['answer'] = $my_answer;
					}
					break;

				case 'mobile':
					$my_answer = \dash\validate::mobile($my_answer);
					$answer[$item_id] = $my_answer;

					if($check_unique)
					{
						$check_unique_args['answer'] = $my_answer;
					}

					break;

				case 'email':
					$my_answer = \dash\validate::email($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'website':
					$my_answer = \dash\validate::url($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'password':
					$my_answer = \dash\validate::string_100($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'yes_no':
					$my_answer = \dash\validate::bit($my_answer);
					if(!$my_answer)
					{
						$my_answer = 0;
					}
					$answer[$item_id] = $my_answer;
					break;

				default:
					\dash\notif::error(T_("Invalid item type"));
					return false;
					break;
			}


			if($check_unique && !empty($check_unique_args))
			{
				$check_unique_args['item_id'] = $item_id;
				$check_unique_args['form_id'] = $data['form_id'];
				$is_answer_befor = \lib\db\form_answerdetail\get::get_where($check_unique_args);
				if(isset($is_answer_befor['id']))
				{
					\dash\notif::warn(T_("You are answer to this form before"));
					return false;
				}
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


		$insert_answerdetail = [];

		foreach ($answer as $item_id => $my_answer)
		{
			if(isset($my_answer))
			{
				if(is_array($my_answer))
				{
					foreach ($my_answer as $my_answer_one)
					{
						$insert_answerdetail[] =
						[
							'form_id'     => $data['form_id'],
							'user_id'     => $data['user_id'],
							'answer_id'   => null,
							'item_id'     => $item_id,
							'answer'      => $my_answer_one,
							'datecreated' => date("Y-m-d H:i:s"),
						];
					}
				}
				else
				{
					$insert_answerdetail[] =
					[
						'form_id'     => $data['form_id'],
						'user_id'     => $data['user_id'],
						'answer_id'   => null,
						'item_id'     => $item_id,
						'answer'      => $my_answer,
						'datecreated' => date("Y-m-d H:i:s"),
					];
				}
			}
		}

		if($insert_answerdetail)
		{
			$add_answer = \lib\db\form_answer\insert::new_record($add_answer_args);

			if(!$add_answer)
			{
				\dash\log::oops('formAddAnswer');
				return false;
			}

			foreach ($insert_answerdetail as $key => $value)
			{
				$insert_answerdetail[$key]['answer_id'] = $add_answer;
			}

			$anwer_detail = \lib\db\form_answerdetail\insert::multi_insert($insert_answerdetail);

			\dash\notif::ok(T_("Your answer was saved"));
		}
		else
		{
			\dash\notif::info(T_("Your form is empty"));
		}


		return true;
	}
}
?>