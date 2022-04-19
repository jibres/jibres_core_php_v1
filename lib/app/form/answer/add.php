<?php
namespace lib\app\form\answer;


class add
{
	public static function public_new_answer($_args)
	{
		$condition =
		[
			'form_id'   => 'id',
			'user_id'   => 'id',
			'factor_id' => 'id',
			'startdate' => 'datetime',
			'answer'    => 'bit', // just for skip clean error
		];



		$require = ['form_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$form_id = $data['form_id'];

		$multiple_choice_answer = [];

		$signup_user_args   = [];
		$signup_user        = false;
		$total_price        = 0;
		$send_sms           = [];
		$sms_text           = [];
		$requred_not_answer = [];

		$answer = isset($_args['answer']) ? $_args['answer'] : [];
		if(!is_array($answer))
		{
			$answer = [];
		}

		$answer_detail = [];

		$load_form = \lib\app\form\form\get::public_get($form_id);
		if(!$load_form)
		{
			return false;
		}

		$check_true_item = \lib\app\form\item\get::items($form_id);

		if(!$check_true_item || !is_array($check_true_item))
		{
			return false;
		}

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

			$mindate           = null;
			$maxdate           = null;

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


			if(isset($item_detail['setting'][$type]['mindate']) && $item_detail['setting'][$type]['mindate'] && strtotime($item_detail['setting'][$type]['mindate']))
			{
				$mindate = strtotime(\dash\utility\jdate::to_gregorian($item_detail['setting'][$type]['mindate']));
			}

			if(isset($item_detail['setting'][$type]['maxdate']) && $item_detail['setting'][$type]['maxdate'] && strtotime($item_detail['setting'][$type]['maxdate']))
			{
				$maxdate = strtotime(\dash\utility\jdate::to_gregorian($item_detail['setting'][$type]['maxdate']));
			}


			$check_unique = false;
			if(isset($item_detail['setting'][$type]['check_unique']) && $item_detail['setting'][$type]['check_unique'])
			{
				$check_unique = true;
			}

			$is_required = false;

			if(isset($item_detail['require']) && $item_detail['require'])
			{
				$is_required = true;
				if((!$my_answer && $my_answer !== '0') || (is_array($my_answer) && empty($my_answer)) || (is_array($my_answer) && empty(array_filter($my_answer))))
				{
					if(isset($item_detail['type']) && $item_detail['type'] === 'message' )
					{
						continue;
					}
					elseif(isset($item_detail['type']) && $item_detail['type'] === 'file' && \dash\request::files('a_'. $item_id))
					{
						// in file mode check file sended or no
						continue;
					}
					else
					{
						$requred_not_answer[] = ['message' => T_(":val is required", ['val' => a($item_detail, 'title')]), 'element' => 'a_'. $item_id];
						continue;
					}
				}

			}

			$validate_meta                = [];
			$validate_meta['element']     = 'a_'. $item_id;
			$validate_meta['field_title'] = $item_detail['title'];

			switch ($type)
			{
				case 'displayname':
					$my_answer                       = \dash\validate::displayname($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					$signup_user_args['displayname'][] = $my_answer;
					break;
				case 'short_answer':
					if(!$maxlen)
					{
						$maxlen = 200;
					}

					$fn               = 'string_'. $maxlen;
					$my_answer        = \dash\validate::$fn($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
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

					$my_answer        = \dash\validate::$fn($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				// case 'descriptive_after_short_answer':
				// 	$my_answer         = \dash\validate::string_100($my_answer);
				// 	$answer[$item_id] = ['answer' => $my_answer];
				// 	break;

				case 'numeric':
					$my_answer        = \dash\validate::number($my_answer, true, array_merge($validate_meta, ['min' => $min, 'max' => $max]));
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'ircard':
					$my_answer        = \dash\validate::ircard($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'irshaba':
					$my_answer        = \dash\validate::irshaba($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'manual_amount':
				case 'hidden_amount':
				case 'list_amount':
					$my_answer        = \dash\validate::price($my_answer, true, array_merge($validate_meta, ['min' => $min, 'max' => $max]));
					$answer[$item_id] = ['answer' => $my_answer];
					$total_price += $my_answer;
					break;

				case 'single_choice':
					$my_answer        = \dash\validate::string_200($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer, 'choice_id' => self::find_choice_id($item_id, $my_answer, $items)];
					break;

				case 'multiple_choice':

					$multiple_choice_answer = [];

					if(!is_array($my_answer))
					{
						$my_answer = [];
					}

					foreach ($my_answer as $k => $v)
					{
						$multiple_choice_answer[] = ['answer' => \dash\validate::string_200($v, true, $validate_meta), 'choice_id' => self::find_choice_id($item_id, $v, $items)];
					}

					if($min)
					{
						if(count($multiple_choice_answer) < $min)
						{
							\dash\notif::error(T_("You must select at least :min options", ['min' => \dash\fit::number($min)]), ['title' => a($item_detail, 'title')]);
							return false;
						}
					}

					if($max)
					{
						if(count($multiple_choice_answer) > $max)
						{
							\dash\notif::error(T_("You can choose up to :max options", ['max' => \dash\fit::number($max)]), ['title' => a($item_detail, 'title')]);
							return false;
						}
					}

					$answer[$item_id] = $multiple_choice_answer;
					break;

				case 'dropdown':
					$my_answer        = \dash\validate::string_200($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer, 'choice_id' => self::find_choice_id($item_id, $my_answer, $items)];
					break;

				case 'date':
					$my_answer        = \dash\validate::date($my_answer, true, $validate_meta);

					if(!self::check_min_max_date($my_answer, $mindate, $maxdate))
					{
						\dash\notif::error(T_("Your date is not in allowd range"), ['title' => a($item_detail, 'title')]);
						return false;
					}

					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'birthdate':
					$my_answer                    = \dash\validate::birthdate($my_answer, true, $validate_meta);

					if(!self::check_min_max_date($my_answer, $mindate, $maxdate))
					{
						\dash\notif::error(T_("Your date is not in allowd range"), ['title' => a($item_detail, 'title')]);
						return false;
					}

					$answer[$item_id] = ['answer' => $my_answer];
					$signup_user_args['birthday'][] = $my_answer;
					break;

				case 'country':
					$my_answer        = \dash\validate::country($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'province':
					$my_answer        = \dash\validate::province($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'province_city':
					if(is_array($my_answer))
					{
						$province            = null;
						$city                = null;
						$array_province_city = [];

						if(isset($my_answer[0]))
						{
							$province              = \dash\validate::province($my_answer[0], true, $validate_meta);
							$array_province_city[] = $province;
						}

						if(isset($my_answer[1]))
						{
							$city                  = \dash\validate::city($my_answer[1], true, $validate_meta);
							if($is_required && !$city)
							{
								$requred_not_answer[] = ['message' => T_(":val is required", ['val' => T_("City")]), 'element' => 'a_'. $item_id];
							}

							if($city)
							{
								$array_province_city[] = $city;
							}
						}

						$answer[$item_id] = ['answer' => implode('-', $array_province_city)];

					}
					break;

				case 'gender':
					$my_answer                  = \dash\validate::enum($my_answer, true, array_merge($validate_meta, ['enum' => ['male', 'female']]));
					$answer[$item_id] = ['answer' => $my_answer];
					$signup_user_args['gender'][] = $my_answer;
					break;

				case 'time':
					$my_answer        = \dash\validate::time($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'tel':
					$my_answer        = \dash\validate::phone($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'file':
					if(\dash\request::files('a_'. $item_id))
					{
						$ext = null;
						if(isset($item_detail['setting']['file']['filetype']))
						{
							$ext = $item_detail['setting']['file']['filetype'];
						}

						$path = \dash\upload\form::upload($form_id, 'a_'. $item_id, 1, $ext);
						if(!\dash\engine\process::status())
						{
							return false;
						}
						$my_answer        = $path;
						$answer[$item_id] = ['answer' => $my_answer];
					}

					break;

				case 'postalcode':
					$my_answer        = \dash\validate::postcode_ir($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'nationalcode':
					$my_answer        = \dash\validate::nationalcode($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];

					if($check_unique)
					{
						$check_unique_args['answer'] = $my_answer;
					}
					break;

				case 'mobile':
					$my_answer                  = \dash\validate::mobile($my_answer, true, $validate_meta);

					$answer[$item_id] = ['answer' => $my_answer];

					$signup_user_args['mobile'][] = $my_answer;

					if(isset($item_detail['setting']['mobile']['signup']) && $item_detail['setting']['mobile']['signup'])
					{
						$signup_user = true;
					}

					if(isset($item_detail['setting']['mobile']['send_sms']) && $item_detail['setting']['mobile']['send_sms'])
					{
						$send_sms[] = true;
					}

					if(isset($item_detail['setting']['mobile']['sms_text']) && $item_detail['setting']['mobile']['sms_text'])
					{
						$sms_text[] = $item_detail['setting']['mobile']['sms_text'];
					}

					if($check_unique)
					{
						$check_unique_args['answer'] = $my_answer;
					}
					break;

				case 'email':
					$my_answer                  = \dash\validate::email($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					$signup_user_args['email'][] = $my_answer;
					break;

				case 'website':
					$my_answer        = \dash\validate::url($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'hidden':
					$my_answer        = \dash\validate::string_200($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'password':
					$my_answer        = \dash\validate::string_100($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'yes_no':
					$my_answer        = \dash\validate::enum($my_answer, true, array_merge($validate_meta, ['enum' => ['yes', 'no']]));
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'agree':
					$my_answer = \dash\validate::bit($my_answer, true, $validate_meta);
					if(!$my_answer)
					{
						$my_answer = 0;
					}
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'message':
					// no answer in message
					break;

				default:
					\dash\notif::error(T_("Invalid item type"));
					return false;
					break;
			}


			if($check_unique && !empty($check_unique_args) && isset($check_unique_args['answer']))
			{
				$check_unique_args_new            = [];
				$check_unique_args_new['item_id'] = $item_id;
				$check_unique_args_new['form_id'] = $form_id;
				$check_unique_args_new['answer']  = $check_unique_args['answer'];

				$is_answer_befor = \lib\db\form_answerdetail\get::get_where($check_unique_args_new);
				if(isset($is_answer_befor['id']))
				{
					\dash\notif::error(T_("You are answer to this form before"));
					return false;
				}
			}
		}


		if($requred_not_answer)
		{
			if(count($requred_not_answer) <= 2)
			{
				foreach ($requred_not_answer as $key => $value)
				{
					\dash\notif::error($value['message'], ['element' => $value['element']]);
				}
				return false;
			}
			else
			{
				\dash\notif::error(T_("Please fill the required field"), ['alerty' => true, 'element' => array_column($requred_not_answer, 'element')]);
				return false;
			}
		}

		if($signup_user && !empty($signup_user_args))
		{
			$new_signup_user = [];

			// we only 5 signup form option
			for ($i = 0; $i <= 5 ; $i++)
			{
				$temp = [];

				if(isset($signup_user_args['displayname'][$i]))
				{
					$temp['displayname'] = $signup_user_args['displayname'][$i];
				}

				if(isset($signup_user_args['birthday'][$i]))
				{
					$temp['birthday'] = $signup_user_args['birthday'][$i];
				}

				if(isset($signup_user_args['gender'][$i]))
				{
					$temp['gender'] = $signup_user_args['gender'][$i];
				}

				if(isset($signup_user_args['mobile'][$i]))
				{
					$temp['mobile'] = $signup_user_args['mobile'][$i];
				}

				if(isset($signup_user_args['email'][$i]))
				{
					$temp['email'] = $signup_user_args['email'][$i];
				}

				if(isset($sms_text[$i]))
				{
					$temp['sms_text'] = $sms_text[$i];
				}


				if(isset($send_sms[$i]))
				{
					$temp['send_sms'] = $send_sms[$i];
				}

				if((isset($temp['mobile']) && $temp['mobile']) || (isset($temp['email']) && $temp['email']))
				{
					$new_signup_user[] = $temp;
				}
			}

			if(!empty($new_signup_user))
			{
				foreach ($new_signup_user as $key => $value)
				{
					$my_send_sms = null;
					if(isset($value['send_sms']) && $value['send_sms'])
					{
						$my_send_sms = $value['send_sms'];
					}

					$my_sms_text = null;
					if(isset($value['sms_text']) && $value['sms_text'])
					{
						$my_sms_text = $value['sms_text'];
					}

					unset($value['sms_text']);
					unset($value['send_sms']);

					$user_id = \dash\db\users\insert::signup($value);

					if($my_send_sms && $my_sms_text && $user_id && isset($value['mobile']))
					{
						// send notif by sms for nabarvari.khadije.com
						if(intval(\lib\store::id()) === 1000089)
						{
							\dash\log::send_sms($user_id, $my_sms_text);
						}
						else
						{
							\dash\log::send_notif($user_id, $my_sms_text);
						}
					}
				}
			}
		}


		$startdate = $data['startdate'];

		if(!$startdate)
		{
			$data['startdate'] = date("Y-m-d H:i:s");
		}

		if($startdate && time() - strtotime($startdate) > (60*60*1))
		{
			$data['startdate'] = date("Y-m-d H:i:s", time() - (60*60*1));
		}

		$add_answer_args =
		[
			'form_id'     => $form_id,
			'user_id'     => $data['user_id'],
			'factor_id'   => $data['factor_id'],
			'datecreated' => date("Y-m-d H:i:s"),
			'startdate'   => $data['startdate'],
			'enddate'     => date("Y-m-d H:i:s"),
		];


		$insert_answerdetail = [];

		foreach ($answer as $item_id => $my_answer)
		{
			if(isset($my_answer))
			{
				if(isset($my_answer[0]))
				{
					foreach ($my_answer as $my_answer_one)
					{
						$insert_answerdetail[] =
						[
							'form_id'     => $form_id,
							'user_id'     => $data['user_id'],
							'answer_id'   => null, // fill after this foreach
							'item_id'     => $item_id,
							'answer'      => $my_answer_one['answer'],
							'choice_id'   => a($my_answer_one, 'choice_id'),
							'textarea'    => null,
							'datecreated' => date("Y-m-d H:i:s"),
						];
					}
				}
				else
				{
					$myType = null;
					if(isset($items[$item_id]['type']))
					{
						$myType = $items[$item_id]['type'];
					}

					$new_answer   = null;
					$new_textarea = null;

					if(in_array($myType, ['descriptive_answer']))
					{
						$new_answer   = null;
						$new_textarea = $my_answer['answer'];
					}
					else
					{
						$new_answer   = $my_answer['answer'];
						$new_textarea = null;
					}

					$insert_answerdetail[] =
					[
						'form_id'     => $form_id,
						'user_id'     => $data['user_id'],
						'answer_id'   => null, // fill after this foreach
						'item_id'     => $item_id,
						'answer'      => $new_answer,
						'choice_id'   => a($my_answer, 'choice_id'),
						'textarea'    => $new_textarea,
						'datecreated' => date("Y-m-d H:i:s"),
					];
				}
			}
		}

		$redirect = null;

		if(isset($load_form['redirect']) && $load_form['redirect'])
		{
			$redirect = $load_form['redirect'];
		}

		if($insert_answerdetail)
		{
			if($total_price && !$data['factor_id'])
			{
				$meta =
				[
					'turn_back' => $redirect ? $redirect : \dash\url::pwd(),
					'user_id'   => $data['user_id'],
					'amount'    => $total_price,
					'auto_back' => true,
				];

				// go to pay
				$transaction_detail = \dash\utility\pay\start::api($meta);

				if(isset($transaction_detail['transaction_id']))
				{
					$add_answer_args['transaction_id'] = \dash\coding::decode($transaction_detail['transaction_id']);
				}

				if(isset($transaction_detail['url']))
				{
					$redirect = $transaction_detail['url'];
				}

			}
			// save ip id
			$add_answer_args['ip_id']    = \dash\utility\ip::id();

			// save agent id
			$add_answer_args['agent_id'] = \dash\agent::get(true);

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

			\dash\log::set('form_newAnswer', ['my_form_id' => $form_id, 'my_answer_id' => $add_answer]);
		}
		else
		{
			\dash\notif::error(T_("No answer received"));
		}


		if($redirect)
		{
			\dash\redirect::to($redirect);
		}


		return true;
	}



	private static function find_choice_id($_item_id, $_answer, $_items)
	{
		$choice = [];

		if(isset($_items[$_item_id]['choice']) && is_array($_items[$_item_id]['choice']))
		{
			$choice = $_items[$_item_id]['choice'];
		}

		foreach ($choice as $key => $value)
		{
			if(isset($value['title']) && isset($value['id']) && $value['title'] === $_answer)
			{
				return $value['id'];
			}
		}

		return null;
	}


	public static function check_min_max_date($_value, $_mindate, $_maxdate)
	{
		if(!$_value)
		{
			return true;
		}


		$value = strtotime($_value);
		if(!$value)
		{
			return true;
		}


		if($_mindate && $value < $_mindate)
		{
			return false;
		}

		if($_maxdate && $value > $_maxdate)
		{
			return false;
		}

		return true;
	}
}
?>