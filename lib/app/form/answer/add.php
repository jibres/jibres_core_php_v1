<?php
namespace lib\app\form\answer;


class add
{

	public static function public_new_answer($_args, $_meta = [])
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

		$user_id              = $data['user_id'];
		$new_signuped_user_id = null;

		$form_id = $data['form_id'];

		$multiple_choice_answer = [];

		$signup_user_args      = [];
		$signup_user           = false;
		$save_as_ticket        = false;
		$edit_mode             = false;
		$total_price           = 0;
		$havePriceItem         = false;
		$send_sms              = [];
		$sms_text              = [];
		$required_not_answered = [];
		$checkRequired         = true;
		$fillByUser            = true;

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

		if(isset($load_form['answerlimit']) && $load_form['answerlimit'] && is_numeric($load_form['answerlimit']))
		{
			$answerLimit              = intval($load_form['answerlimit']);
			$getTotalActiveAnserCount = \lib\db\form_answer\get::countActive($form_id);

			if(floatval($getTotalActiveAnserCount) >= $answerLimit)
			{
				\dash\notif::error(T_("The answer limit of this form is full. You can not add your answer. Plese contacto to administrator"), ['alerty' => true]);
				return false;
			}

		}

		if(a($load_form, 'setting', 'saveasticket'))
		{
			$save_as_ticket = true;
		}

		if(a($_meta, 'edit_mode') === true && a($_meta, 'answer_id'))
		{
			$fillByUser      = false;
			$checkRequired   = false;
			$check_true_item = \lib\app\form\item\get::items_answer($form_id, $_meta['answer_id'], true, true);
			$edit_mode       = true;
		}
		else
		{
			if(\dash\data::fillByAdmin())
			{
				$fillByUser      = false;
				$checkRequired   = false;
				$check_true_item = \lib\app\form\item\get::items($form_id, false, false, true);
			}
			else
			{
				$check_true_item = \lib\app\form\item\get::items($form_id);
			}
		}

		if($fillByUser)
		{
			if(($myStartTime = \lib\app\form\form\get::getMyStartTime($form_id)) && a($load_form, 'setting', 'timelimit'))
			{
				$timeLimit   = $load_form['setting']['timelimit'];

				if((time() - floatval($myStartTime)) > floatval($timeLimit))
				{
					\lib\app\form\form\get::resetMyStartTime($form_id);
					\dash\notif::error(T_("The deadline for your response to this form has expired. It is not possible to save your answer, The page will be reload automatically"), ['alerty' => true]);
					\dash\redirect::pwd();
					return false;
				}

			}
		}

		$check_true_item =
			\lib\app\form\condition\check::true_item($check_true_item, a($load_form, 'condition'), $answer);


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
			$length            = 0;
			$max               = 99999999999999;

			$mindate = null;
			$maxdate = null;

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

			if(isset($item_detail['setting'][$type]['length']) && is_numeric($item_detail['setting'][$type]['length']))
			{
				$length = floatval($item_detail['setting'][$type]['length']);
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
					if(isset($item_detail['type']) && $item_detail['type'] === 'message')
					{
						continue;
					}
					elseif(isset($item_detail['type']) && $item_detail['type'] === 'random')
					{
						continue;
					}
					elseif(isset($item_detail['type']) && $item_detail['type'] === 'hiddenurl' && !a($item_detail, 'setting', 'hiddenurl', 'urlkey'))
					{
						// user not set the url key but set item as required!
						// skipp required
						continue;
					}
					elseif(isset($item_detail['type']) && $item_detail['type'] === 'file' && \dash\request::files('a_' . $item_id))
					{
						// in file mode check file sended or no
						continue;
					}
					else
					{
						if(a($item_detail, 'status') === 'deleted')
						{
							// needless to add to required field
						}
						else
						{
							$required_not_answered[] = [
								'message' => T_(":val is required", ['val' => a($item_detail, 'title')]),
								'element' => 'a_' . $item_id,
							];
							continue;
						}
					}
				}

			}

			$validate_meta                = [];
			$validate_meta['element']     = 'a_' . $item_id;
			$validate_meta['field_title'] = $item_detail['title'];

			switch ($type)
			{
				case 'random':

					if($length < 1 || $length > 50)
					{
						$length = 10;
					}

					$alphabet = '1234567890';

					if(isset($item_detail['setting'][$type]['lowercase']) && $item_detail['setting'][$type]['lowercase'])
					{
						$alphabet .= 'abcdefghijklmnopqrstuvwxyz';
					}

					if(isset($item_detail['setting'][$type]['uppercase']) && $item_detail['setting'][$type]['uppercase'])
					{
						$alphabet .= strtoupper('abcdefghijklmnopqrstuvwxyz');
					}

					$my_answer = \dash\utility\random::string($length, $alphabet);

					$answer[$item_id] = ['answer' => $my_answer];
					break;


				case 'displayname':
					$my_answer                         = \dash\validate::displayname($my_answer, true, $validate_meta);
					$answer[$item_id]                  = ['answer' => $my_answer];
					$signup_user_args['displayname'][] = $my_answer;
					break;

				case 'short_answer':
					if(!$maxlen)
					{
						$maxlen = 200;
					}

					$fn               = 'string_' . $maxlen;
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
						$fn = 'string_' . $maxlen;
					}

					$my_answer        = \dash\validate::$fn($my_answer, true, $validate_meta);
					$answer[$item_id] = ['answer' => $my_answer];
					break;

				// case 'descriptive_after_short_answer':
				// 	$my_answer         = \dash\validate::string_100($my_answer);
				// 	$answer[$item_id] = ['answer' => $my_answer];
				// 	break;

				case 'numeric':
					$my_answer        = \dash\validate::number($my_answer, true, array_merge($validate_meta, [
						'min' => $min, 'max' => $max,
					]));
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
				case 'amount_suggestion':
					$my_answer        = \dash\validate::price($my_answer, true, array_merge($validate_meta, [
						'min' => $min, 'max' => $max,
					]));
					$answer[$item_id] = ['answer' => $my_answer];
					$total_price      += $my_answer;
					$havePriceItem    = true;
					break;

				case 'single_choice':
					$my_answer        = \dash\validate::string_200($my_answer, true, $validate_meta);
					$answer[$item_id] =
						['answer' => $my_answer, 'choice_id' => self::find_choice_id($item_id, $my_answer, $items)];
					break;

				case 'multiple_choice':

					$multiple_choice_answer = [];

					if(!is_array($my_answer))
					{
						$my_answer = [];
					}

					foreach ($my_answer as $k => $v)
					{
						$multiple_choice_answer[] = [
							'answer'    => \dash\validate::string_200($v, true, $validate_meta),
							'choice_id' => self::find_choice_id($item_id, $v, $items),
						];
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
					$answer[$item_id] =
						['answer' => $my_answer, 'choice_id' => self::find_choice_id($item_id, $my_answer, $items)];
					break;

				case 'date':
					$my_answer = \dash\validate::date($my_answer, true, $validate_meta);

					if(!self::check_min_max_date($my_answer, $mindate, $maxdate))
					{
						\dash\notif::error(T_("Your date is not in allowd range"), ['title' => a($item_detail, 'title')]);
						return false;
					}

					$answer[$item_id] = ['answer' => $my_answer];
					break;

				case 'birthdate':
					$my_answer = \dash\validate::birthdate($my_answer, true, $validate_meta);

					if(!self::check_min_max_date($my_answer, $mindate, $maxdate))
					{
						\dash\notif::error(T_("Your date is not in allowd range"), ['title' => a($item_detail, 'title')]);
						return false;
					}

					$answer[$item_id]               = ['answer' => $my_answer];
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
							$city = \dash\validate::city($my_answer[1], true, $validate_meta);
							if($is_required && !$city)
							{
								$required_not_answered[] = [
									'message' => T_(":val is required", ['val' => T_("City")]),
									'element' => 'a_' . $item_id,
								];
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
					$my_answer                    = \dash\validate::enum($my_answer, true, array_merge($validate_meta, [
						'enum' => [
							'male', 'female',
						],
					]));
					$answer[$item_id]             = ['answer' => $my_answer];
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
					if(\dash\request::files('a_' . $item_id))
					{
						$ext = null;
						if(isset($item_detail['setting']['file']['filetype']))
						{
							$ext = $item_detail['setting']['file']['filetype'];
						}

						$path = \dash\upload\form::upload($form_id, 'a_' . $item_id, 1, $ext);
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

				case 'hiddenurl':
					$my_answer = \dash\validate::string_100($my_answer, true, $validate_meta);
					$urlkey    = null;
					if(isset($item_detail['setting']['hiddenurl']['urlkey']))
					{
						$urlkey = $item_detail['setting']['hiddenurl']['urlkey'];
					}


					$my_value = null;

					if($urlkey && \dash\request::key_exists($urlkey, 'GET'))
					{
						$my_value = \dash\request::get($urlkey);

						if(isset($item_detail['setting']['hiddenurl']['whitelist']) && is_array($item_detail['setting']['hiddenurl']['whitelist']))
						{
							if(!in_array($my_value, $item_detail['setting']['hiddenurl']['whitelist']))
							{
								$my_value = null;
							}
						}
						else
						{
							$my_value = \dash\validate::string_100($my_value, false);
						}
					}
					else
					{
						if(isset($item_detail['setting']['hidden']['defaultvalue']))
						{
							$my_value = $item_detail['setting']['hidden']['defaultvalue'];
						}
					}

					$answer[$item_id] = ['answer' => $my_value];

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
					$my_answer = \dash\validate::mobile($my_answer, true, $validate_meta);

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
					$my_answer                   = \dash\validate::email($my_answer, true, $validate_meta);
					$answer[$item_id]            = ['answer' => $my_answer];
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
					$my_answer        =
						\dash\validate::enum($my_answer, true, array_merge($validate_meta, ['enum' => ['yes', 'no']]));
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

				$is_answer_befor = \lib\db\form_answerdetail\get::check_duplicate_answer($check_unique_args_new);

				if(isset($is_answer_befor['id']))
				{
					if($edit_mode && floatval($_meta['answer_id']) === floatval($is_answer_befor['answer_id']))
					{
						// nothing
						// just update current answer
					}
					else
					{
						\dash\notif::error(T_("You are answer to this form before"));
						return false;
					}
				}

				if(a($item_detail, 'uniquelist') && is_string($item_detail['uniquelist']))
				{
					$check_manuall_unique_list = explode(',', $item_detail['uniquelist']);

					if(in_array($my_answer, $check_manuall_unique_list))
					{
						\dash\notif::error(T_("You are answer to this form before"));
						return false;
					}
				}
			}
		}


		if($required_not_answered && $checkRequired)
		{
			if(count($required_not_answered) <= 2)
			{
				foreach ($required_not_answered as $key => $value)
				{
					\dash\notif::error($value['message'], ['element' => $value['element']]);
				}
				return false;
			}
			else
			{
				\dash\notif::error(T_("Please fill the required field"), [
					'alerty'  => true,
					'element' => array_column($required_not_answered, 'element'),
				]);
				return false;
			}
		}

		if($signup_user && !empty($signup_user_args))
		{
			$new_signup_user = [];

			// we only 5 signup form option
			for ($i = 0 ; $i <= 5 ; $i++)
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

					$new_signuped_user_id = \dash\db\users\insert::signup($value);

					if(!$edit_mode && $my_send_sms && $my_sms_text && $new_signuped_user_id && isset($value['mobile']))
					{
						// send notif by sms for nabarvari.khadije.com + sobati
						if(\lib\app\form\form\get::enterpriseSpecialFormBuilder())
						{
							\dash\log::send_sms($new_signuped_user_id, $my_sms_text);
						}
						else
						{
							\dash\log::send_notif($new_signuped_user_id, $my_sms_text);
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

		if(!$edit_mode && $startdate && time() - strtotime($startdate) > (60 * 60 * 1))
		{
			$data['startdate'] = date("Y-m-d H:i:s", time() - (60 * 60 * 1));
		}

		if(!$user_id && $new_signuped_user_id)
		{
			$user_id = $new_signuped_user_id;
		}

		$add_answer_args =
			[
				'form_id'     => $form_id,
				'user_id'     => $user_id,
				'factor_id'   => $data['factor_id'],
				'datecreated' => date("Y-m-d H:i:s"),
				'startdate'   => $data['startdate'],
				'enddate'     => date("Y-m-d H:i:s"),
				'amount'      => $havePriceItem ? $total_price : null,
			];

		if($total_price)
		{
			$add_answer_args['status'] = 'draft';
		}
		else
		{
			$add_answer_args['status'] = 'active';

		}


		$insert_answerdetail = [];

		foreach ($answer as $item_id => $my_answer)
		{
			if(isset($my_answer))
			{
				if(is_array($my_answer) && isset($my_answer[0]))
				{
					foreach ($my_answer as $my_answer_one)
					{
						$insert_answerdetail[] =
							[
								'form_id'     => $form_id,
								'user_id'     => $user_id,
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
						$new_textarea = a($my_answer, 'answer');
					}
					else
					{
						$new_answer   = a($my_answer, 'answer');
						$new_textarea = null;
					}

					$insert_answerdetail[] =
						[
							'form_id'     => $form_id,
							'user_id'     => $user_id,
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
			$answer_id = null;

			if(!$edit_mode)
			{
				// save ip id
				$add_answer_args['ip_id'] = \dash\utility\ip::id();

				// save agent id
				$add_answer_args['agent_id'] = \dash\agent::get(true);


				$answer_id = \lib\db\form_answer\insert::new_record($add_answer_args);

				if(!$answer_id)
				{
					\dash\log::oops('formAddAnswer');
					\dash\notif::error(T_("Can not save your answer. Please contact to administrator"));
					return false;
				}

				\lib\app\form\form\get::resetMyStartTime($form_id);

				foreach ($insert_answerdetail as $key => $value)
				{
					$insert_answerdetail[$key]['answer_id'] = $answer_id;
				}

				$anwer_detail = \lib\db\form_answerdetail\insert::multi_insert($insert_answerdetail);

				\dash\log::set('form_newAnswer', ['my_form_id' => $form_id, 'my_answer_id' => $answer_id]);
			}
			else
			{
				$edit = edit::answer($insert_answerdetail, $check_true_item, a($_meta, 'answer_id'));

				if(!$edit)
				{
					\dash\log::oops('formAddAnswer');
					\dash\notif::error(T_("Can not edit your answer. Please contact to administrator"));
					return false;
				}

				\dash\log::set('form_editAnswer', ['my_form_id' => $form_id, 'my_answer_id' => a($_meta, 'answer_id')]);

				\dash\notif::ok(T_("Answer update successfull"));

				return true;
			}


			if($total_price && !$data['factor_id'])
			{
				$pwdClean = \dash\url::current();
				$allGet   = \dash\request::get();
				unset($allGet['jftoken']);
				$pwdClean .= '?' . \dash\request::build_query($allGet);

				$meta =
					[
						'turn_back'     => $redirect ? $redirect : $pwdClean,
						'user_id'       => $user_id,
						'amount'        => $total_price,
						'auto_back'     => false,
						'final_msg'     => true,
						'final_fn'      => ['/lib/app/form/answer/add', 'after_pay'],
						'final_fn_args' => ['answer_id' => $answer_id, 'form_id' => $form_id],
					];

				// go to pay
				$transaction_detail = \dash\utility\pay\start::api($meta);

				if(isset($transaction_detail['transaction_id']))
				{
					$update_answer                   = [];
					$update_answer['transaction_id'] = \dash\coding::decode($transaction_detail['transaction_id']);
					\lib\db\form_answer\update::update($update_answer, $answer_id);
				}

				if(isset($transaction_detail['url']))
				{
					$redirect = $transaction_detail['url'];
				}
			}

			if(isset($load_form['endmessage']) && $load_form['endmessage'])
			{
				\dash\notif::ok($load_form['endmessage'], ['alerty' => true]);
			}
			else
			{
				\dash\notif::ok(T_("Your answer was saved"), ['alerty' => true]);
			}
		}
		else
		{
			\dash\notif::error(T_("No answer received"));
		}

		if($save_as_ticket && !$total_price)
		{
			$ticket_id = save_as_ticket::save($form_id, $answer_id);
		}

		self::checkDefaultTag($form_id, $answer_id);

		if($redirect && !$edit_mode)
		{
			\dash\redirect::to($redirect);
		}


		return true;
	}


	public static function after_pay($_args, $_transaction_detail = [])
	{
		if(isset($_args['answer_id']) && is_numeric($_args['answer_id']))
		{
			\lib\db\form_answer\edit::update(['status' => 'active', 'payed' => 1], $_args['answer_id']);

			$load_answer = \lib\db\form_answer\get::by_id($_args['answer_id']);

			if(isset($load_answer['user_id']) && isset($_transaction_detail['plus']))
			{
				// minus transaction

				$insert_transaction =
					[
						'user_id'      => $load_answer['user_id'],
						'title'        => T_("Pay for form :val", ['val' => \dash\fit::number($_args['form_id'])]),
						'amount'       => floatval($_transaction_detail['plus']),
						'silent_notif' => true,
					];

				$transaction_id = \dash\app\transaction\budget::minus($insert_transaction);

				\dash\temp::set('minusTransactionAfterPayForm', $transaction_id);
				\dash\temp::set('minusTransactionAfterPayFormPrice', $_transaction_detail['plus']);
			}

			if(isset($_args['form_id']) && is_numeric($_args['form_id']))
			{
				$load_form = \lib\app\form\form\get::public_get($_args['form_id']);

				if($load_form && a($load_form, 'setting', 'saveasticket'))
				{
					$ticket_id = save_as_ticket::save($_args['form_id'], $_args['answer_id']);
				}
			}
		}
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


	private static function checkDefaultTag($_form_id, $_answer_id)
	{
		if(!$_form_id || !$_answer_id)
		{
			return false;
		}

		$getDefaultTag = \lib\db\form_tag\get::isDefaultList($_form_id);

		if(!$getDefaultTag)
		{
			return false;
		}


		\dash\notif::lock();

		foreach ($getDefaultTag as $tagDetail)
		{
			\lib\app\form\tag\add::public_answer_tag_plus($tagDetail['title'], $_answer_id, $_form_id);

		}

		\dash\notif::unlock();

	}

}

?>