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

		$form_id = $data['form_id'];

		$multiple_choice_answer = [];

		$signup_user_args = [];
		$signup_user      = false;
		$send_sms         = false;
		$sms_text         = null;

		$answer = isset($_args['answer']) ? $_args['answer'] : [];
		if(!is_array($answer))
		{
			$answer = [];
		}

		$load_form = \lib\app\form\form\get::get($form_id);
		if(!$load_form)
		{
			return false;
		}

		$check_true_item = \lib\db\form_item\get::by_form_id($form_id);

		if(!$check_true_item || !is_array($check_true_item))
		{
			\dash\notif::error(T_("Invalid item id"));
			return false;
		}

		$check_true_item = array_map(['\\lib\\app\\form\\item\\ready', 'row'], $check_true_item);

		$items = array_combine(array_column($check_true_item, 'id'), $check_true_item);

		foreach ($items as $item_id => $item_detail)
		{
			$my_answer = null;
			if(isset($answer[$item_id]))
			{
				$my_answer = $answer[$item_id];
			}

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
				if((!$my_answer && $my_answer !== '0') || (is_array($my_answer) && empty($my_answer)))
				{
					\dash\notif::error(T_(":val is required", ['val' => \dash\get::index($item_detail, 'title')]));
					return false;
				}

			}

			switch ($type)
			{
				case 'displayname':
					$my_answer                       = \dash\validate::displayname($my_answer);
					$answer[$item_id]                = $my_answer;
					$signup_user_args['displayname'] = $my_answer;
					break;
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

					$my_answer        = \dash\validate::$fn($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				// case 'descriptive_after_short_answer':
				// 	$my_answer         = \dash\validate::string_100($my_answer);
				// 	$answer[$item_id] = $my_answer;
				// 	break;

				case 'numeric':
					$my_answer        = \dash\validate::number($my_answer, true, ['min' => $min, 'max' => $max]);
					$answer[$item_id] = $my_answer;
					break;

				case 'single_choice':
					$my_answer        = \dash\validate::string_100($my_answer);
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

					if($min)
					{
						if(count($multiple_choice_answer) < $min)
						{
							\dash\notif::error(T_("You must select at least :min options", ['min' => \dash\fit::number($min)]), ['title' => \dash\get::index($item_detail, 'title')]);
							return false;
						}
					}

					if($max)
					{
						if(count($multiple_choice_answer) > $max)
						{
							\dash\notif::error(T_("You can choose up to :max options", ['max' => \dash\fit::number($max)]), ['title' => \dash\get::index($item_detail, 'title')]);
							return false;
						}
					}

					$answer[$item_id] = $multiple_choice_answer;
					break;

				case 'dropdown':
					$my_answer        = \dash\validate::string_200($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'date':
					$my_answer        = \dash\validate::date($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'birthdate':
					$my_answer                    = \dash\validate::birthdate($my_answer);
					$answer[$item_id]             = $my_answer;
					$signup_user_args['birthday'] = $my_answer;
					break;

				case 'country':
					$my_answer        = \dash\validate::country($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'province':
					$my_answer        = \dash\validate::province($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'city':
				case 'province_city':
					$my_answer        = \dash\validate::city($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'gender':
					$my_answer                  = \dash\validate::enum($my_answer, true, ['enum' => ['male', 'female']]);
					$answer[$item_id]           = $my_answer;
					$signup_user_args['gender'] = $my_answer;
					break;

				case 'time':
					$my_answer        = \dash\validate::time($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'tel':
					$my_answer        = \dash\validate::phone($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'file':
					if(\dash\request::files('answer_'. $item_id))
					{
						$ext = null;
						if(isset($item_detail['setting']['file']['filetype']))
						{
							$ext = $item_detail['setting']['file']['filetype'];
						}

						$path = \dash\upload\form::upload($form_id, 'answer_'. $item_id, 1, $ext);
						if(!\dash\engine\process::status())
						{
							return false;
						}
						$my_answer        = $path;
						$answer[$item_id] = $my_answer;
					}

					break;

				case 'nationalcode':
					$my_answer        = \dash\validate::nationalcode($my_answer);
					$answer[$item_id] = $my_answer;

					if($check_unique)
					{
						$check_unique_args['answer'] = $my_answer;
					}
					break;

				case 'mobile':
					$my_answer                  = \dash\validate::mobile($my_answer);

					$answer[$item_id]           = $my_answer;

					$signup_user_args['mobile'] = $my_answer;

					if(isset($item_detail['setting']['mobile']['signup']) && $item_detail['setting']['mobile']['signup'])
					{
						$signup_user = true;
					}

					if(isset($item_detail['setting']['mobile']['send_sms']) && $item_detail['setting']['mobile']['send_sms'])
					{
						$send_sms = true;
					}

					if(isset($item_detail['setting']['mobile']['sms_text']) && $item_detail['setting']['mobile']['sms_text'])
					{
						$sms_text = $item_detail['setting']['mobile']['sms_text'];
					}

					if($check_unique)
					{
						$check_unique_args['answer'] = $my_answer;
					}
					break;

				case 'email':
					$my_answer                  = \dash\validate::email($my_answer);
					$answer[$item_id]           = $my_answer;
					$signup_user_args['mobile'] = $my_answer;
					break;

				case 'website':
					$my_answer        = \dash\validate::url($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'password':
					$my_answer        = \dash\validate::string_100($my_answer);
					$answer[$item_id] = $my_answer;
					break;

				case 'agree':
				case 'yes_no':
					$my_answer = \dash\validate::bit($my_answer);
					if(!$my_answer)
					{
						$my_answer = 0;
					}
					$answer[$item_id] = $my_answer;
					break;

				case 'message':
					// no answer in message
					break;

				default:
					\dash\notif::error(T_("Invalid item type"));
					return false;
					break;
			}


			if($check_unique && !empty($check_unique_args))
			{
				$check_unique_args['item_id'] = $item_id;
				$check_unique_args['form_id'] = $form_id;
				$is_answer_befor = \lib\db\form_answerdetail\get::get_where($check_unique_args);
				if(isset($is_answer_befor['id']))
				{
					\dash\notif::warn(T_("You are answer to this form before"));
					return false;
				}
			}
		}

		if($signup_user && !empty($signup_user_args))
		{
			$user_id = \dash\app\user::quick_add_raw($signup_user_args);
			if(isset($user_id['id']))
			{
				$user_id = \dash\coding::decode($user_id['id']);
			}
			else
			{
				$user_id = null;
			}

			if($send_sms && $sms_text && $user_id)
			{
				\dash\log::send_sms($user_id, $sms_text);
			}
		}

		$add_answer_args =
		[
			'form_id'     => $form_id,
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
							'form_id'     => $form_id,
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
						'form_id'     => $form_id,
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

			if(isset($load_form['endmessage']) && $load_form['endmessage'])
			{
				\dash\notif::ok($load_form['endmessage'], ['alerty' => true]);
			}
			else
			{
				\dash\notif::ok(T_("Your answer was saved"), ['alerty' => true]);
			}
		}


		if(isset($load_form['redirect']) && $load_form['redirect'])
		{
			\dash\redirect::to($load_form['redirect']);
		}

		return true;
	}
}
?>