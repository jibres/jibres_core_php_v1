<?php
namespace lib\app\form;


class generator
{

	private static $html = '';

	private static $answer_detail = [];
	private static $load_answer = false;
	private static $schedule_message = '';


	public static function shipping_survey($_form_id)
	{
		$load_form = \lib\app\form\form\get::public_get($_form_id);

		if(!$load_form)
		{
			return null;
		}

		self::$html = '';

		$load_items = \lib\app\form\item\get::items($_form_id);

		self::$html .= '<div class="box">';
		{
			self::$html .= '<div class="pad" >';
			{
				self::$html .= '<input type="hidden" name="startdate" value="' . date("Y-m-d H:i:s") . '">';
				self::$html .= '<input type="hidden" name="answerform" value="answerform">';

				if(a($load_form, 'file'))
				{
					self::$html .= '<img class="mb-2" src="' . a($load_form, 'file') . '" alt="' . a($load_form, 'title') . '">';
				}
				if(a($load_form, 'desc'))
				{
					self::$html .= '<div class="mb-4">' . a($load_form, 'desc') . '</div>';
				}

				\lib\app\form\generator::items($load_items);
			}
			self::$html .= '</div>';
		}
		self::$html .= '</div>';


		return self::$html;
	}


	public static function master_form_page_html()
	{
		$html = '';
		$html .= self::generateFinalMessageFromTransaction();
		$html .= '<div class="box">';
		{

			$html .= '<header class="c-xs-0"><h2>' . \dash\data::formDetail_title() . '</h2></header>';

			$html .= '<div class="body" data-jform>';
			{
				$html .= '<input type="hidden" name="startdate" value="' . date("Y-m-d H:i:s") . '">';
				$html .= \dash\csrf::html();
				$html .= \dash\captcha\recaptcha::html();
				if(\dash\data::formDetail_status() !== 'publish' && \dash\data::accessLoadItem())
				{
					$html .= '<div class="alert-warning text-center font-bold">' . T_("Your form is not publish. Only you can view this form.") . ' <a class="btn-link" href="' . \lib\store::admin_url() . '/a/form/edit?id=' . \dash\data::formDetail_id() . '">' . T_("Edit form") . '</a></div>';
				}

				if(\dash\data::formDetail_file())
				{
					$html .= '<img class="mb-2" src="' . \dash\data::formDetail_file() . '" alt="' . \dash\data::formDetail_title() . '">';
				}
				if(\dash\data::formDetail_desc())
				{
					$html .= '<div class="mb-4 leading-loose">' . nl2br(\dash\data::formDetail_desc()) . '</div>';
				}


				if(\dash\data::accessLoadItem())
				{
					if($allow_form_schedule = self::check_schedule(\dash\data::formDetail_id()))
					{
						$html .= \lib\app\form\generator::items(\dash\data::formItems());
					}
					else
					{
						$html .= self::$schedule_message;
					}
				}
				else
				{
					$html .= '<div class="alert-warning">' . T_("Access to answer to this form is blocked") . '</div>';
				}
			}
			$html .= '</div>';

			if(\dash\data::accessLoadItem() && isset($allow_form_schedule) && $allow_form_schedule)
			{
				$html .= '<footer class="txtRa">';
				{
					$html .= '<button class="btn master">' . T_("Submit") . '</button>';
				}
				$html .= '</footer>';
			}
		}
		$html .= '</div>';

		return $html;
	}


	public static function sitebuilder_full_html($_form_id)
	{
		$load_form = \lib\app\form\form\get::public_get($_form_id);

		if(!$load_form)
		{
			return null;
		}

		$load_items = \lib\app\form\item\get::items($_form_id);

		$action = \dash\url::kingdom() . '/f/' . $_form_id;

		self::$html = '';

		self::$html .= '<form id="jformbuilder" method="post" autocomplete="off" action="' . $action . '" data-clear>';
		{
			self::$html .= '<div class="">';
			{
				self::$html .= self::generateFinalMessageFromTransaction();
				self::$html .= '<div class="box">';
				{
					self::$html .= \dash\csrf::html();
					self::$html .= \dash\captcha\recaptcha::html();
					self::$html .= '<input type="hidden" name="notredirect" value="1" data-unclear>';

					self::$html .= '<header class="c-xs-0"><h2>' . a($load_form, 'title') . '</h2></header>';
					self::$html .= '<div class="body" data-jform>';
					{
						self::$html .= '<input type="hidden" name="startdate" value="' . date("Y-m-d H:i:s") . '">';
						self::$html .= '<input type="hidden" name="answerform" value="answerform">';

						if(a($load_form, 'file'))
						{
							self::$html .= '<img class="mb-2" src="' . a($load_form, 'file') . '" alt="' . a($load_form, 'title') . '">';
						}
						if(a($load_form, 'desc'))
						{
							self::$html .= '<div class="mb-4 leading-relaxed">' . nl2br(a($load_form, 'desc')) . '</div>';
						}

						if($allow_form_schedule = self::check_schedule(\dash\data::formDetail_id()))
						{
							\lib\app\form\generator::items($load_items);
						}
						else
						{
							self::$html .= self::$schedule_message;
						}

					}
					self::$html .= '</div>';

					if(isset($allow_form_schedule) && $allow_form_schedule)
					{
						self::$html .= '<footer class="txtRa">';
						{
							self::$html .= '<button class="btn master">' . T_("Submit") . '</button>';
						}
						self::$html .= '</footer>';
					}

				}
				self::$html .= '</div>';
			}
			self::$html .= '</div>';

		}
		self::$html .= '</form>';

		return self::$html;
	}


	public static function full_html($_form_id, $_option = [])
	{
		$load_form = \lib\app\form\form\get::public_get($_form_id);

		if(!$load_form)
		{
			return null;
		}

		$load_items =
			\lib\app\form\item\get::items($_form_id, true, a($_option, 'delete_item'), a($_option, 'hidden_item'));

		self::$html = '';

		self::$html .= '<form id="jformbuilder" method="post" autocomplete="off">';
		{

			self::$html .= '<div class="">';
			{

				self::$html .= self::generateFinalMessageFromTransaction();
				self::$html .= '<div class="box">';
				{

					self::$html .= '<header class="c-xs-0"><h2>' . a($load_form, 'title') . '</h2></header>';
					self::$html .= '<div class="body" data-jform>';
					{
						self::$html .= '<input type="hidden" name="startdate" value="' . date("Y-m-d H:i:s") . '">';
						self::$html .= '<input type="hidden" name="answerform" value="answerform">';

						if(a($load_form, 'file'))
						{
							self::$html .= '<img class="mb-2" src="' . a($load_form, 'file') . '" alt="' . a($load_form, 'title') . '">';
						}
						if(a($load_form, 'desc'))
						{
							self::$html .= '<div class="mb-4">' . nl2br(a($load_form, 'desc')) . '</div>';
						}

						if($allow_form_schedule = self::check_schedule(\dash\data::formDetail_id()))
						{
							\lib\app\form\generator::items($load_items);
						}
						else
						{
							self::$html .= self::$schedule_message;
						}

					}
					self::$html .= '</div>';

					if(isset($allow_form_schedule) && $allow_form_schedule)
					{
						self::$html .= '<footer class="txtRa">';
						{
							self::$html .= '<button class="btn master">' . T_("Submit") . '</button>';
						}
						self::$html .= '</footer>';
					}
				}
				self::$html .= '</div>';
			}
			self::$html .= '</div>';

		}
		self::$html .= '</form>';

		return self::$html;
	}


	/**
	 * Edit from
	 *
	 * @param <type> $_form_id   The form identifier
	 * @param <type> $_answer_id The answer identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function edit_html($_form_id, $_answer_id = null)
	{
		$load_form = \lib\app\form\form\get::public_get($_form_id);

		if(!$load_form)
		{
			return null;
		}

		$load_items = [];

		if($_answer_id)
		{
			self::$load_answer = true;

			$load_items =
				\lib\app\form\item\get::items_answer(\dash\request::get('id'), \dash\request::get('aid'), true, true);

			if(is_array($load_items))
			{
				self::$answer_detail = $load_items;
			}
		}

		if(!$load_items)
		{
			$load_items = \lib\app\form\item\get::items($_form_id);
		}

		self::$html = '';

		self::$html .= '<form id="jformbuilder" method="post" autocomplete="off">';
		{

			self::$html .= '<div class="">';
			{

				self::$html .= '<div class="box">';
				{
					self::$html .= '<header class="c-xs-0"><h2>' . a($load_form, 'title') . '</h2></header>';
					self::$html .= '<div class="body" data-jform>';
					{
						self::$html .= '<input type="hidden" name="startdate" value="' . date("Y-m-d H:i:s") . '">';
						self::$html .= '<input type="hidden" name="answerform" value="answerform">';


						\lib\app\form\generator::items($load_items);
					}
					self::$html .= '</div>';

					self::$html .= '<footer class="txtRa">';
					{
						self::$html .= '<button class="btn master">' . T_("Submit") . '</button>';
					}
					self::$html .= '</footer>';
				}
				self::$html .= '</div>';
			}
			self::$html .= '</div>';

		}
		self::$html .= '</form>';

		return self::$html;
	}


	public static function items($_items)
	{
		if(!$_items || !is_array($_items))
		{
			return null;
		}

		$form_id = null;

		if(isset($_items[0]['form_id']))
		{
			$form_id = $_items[0]['form_id'];
		}

		self::div('row');
		foreach ($_items as $item)
		{
			if(!isset($item['type']))
			{
				continue;
			}

			$have_condition = \lib\app\form\condition\get::item_have_condition($form_id, $item['id']);

			// if(a($item, 'status') === 'deleted')
			// {
			// 	if(isset($item['user_answer'][0]['answer']))
			// 	{
			// 		// ok
			// 	}
			// 	else
			// 	{
			// 		continue;
			// 	}
			// }


			switch ($item['type'])
			{
				case 'short_answer':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_short_answer($item);
					}
					self::_div_item($have_condition);

					break;

				case 'displayname':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_displayname($item);
					}
					self::_div_item($have_condition);
					break;

				case 'descriptive_answer':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_descriptive_answer($item);
					}
					self::_div_item($have_condition);

					break;

				case 'numeric':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_numeric($item);
					}
					self::_div_item($have_condition);

					break;

				case 'single_choice':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_single_choice($item);
					}
					self::_div_item($have_condition);
					break;

				case 'multiple_choice':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_multiple_choice($item);
					}
					self::_div_item($have_condition);
					break;

				case 'dropdown':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_dropdown($item);
					}
					self::_div_item($have_condition);

					break;

				case 'date':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_date($item);
					}
					self::_div_item($have_condition);

					break;

				case 'birthdate':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_birthdate($item);
					}
					self::_div_item($have_condition);

					break;

				case 'country':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_country($item);
					}
					self::_div_item($have_condition);
					break;

				case 'province':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_province($item);
					}
					self::_div_item($have_condition);

					break;

				case 'province_city':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_province_city($item);
					}
					self::_div_item($have_condition);

					break;

				case 'gender':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_gender($item);
					}
					self::_div_item($have_condition);
					break;

				case 'time':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_time($item);
					}
					self::_div_item($have_condition);

					break;

				case 'ircard':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_ircard($item);
					}
					self::_div_item($have_condition);

					break;

				case 'irshaba':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_irshaba($item);
					}
					self::_div_item($have_condition);

					break;

				case 'tel':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_tel($item);
					}
					self::_div_item($have_condition);
					break;

				case 'file':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_file($item);
					}
					self::_div_item($have_condition);
					break;

				case 'nationalcode':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_nationalcode($item);
					}
					self::_div_item($have_condition);

					break;

				case 'mobile':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_mobile($item);
					}
					self::_div_item($have_condition);

					break;

				case 'email':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_email($item);
					}
					self::_div_item($have_condition);

					break;

				case 'website':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_website($item);
					}
					self::_div_item($have_condition);

					break;

				case 'password':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_password($item);
					}
					self::_div_item($have_condition);

					break;

				case 'yes_no':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_yes_no($item);
					}
					self::_div_item($have_condition);
					break;

				case 'message':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_message($item);
					}
					self::_div_item($have_condition);

					break;

				case 'agree':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_agree($item);
					}
					self::_div_item($have_condition);
					break;

				case 'hidden':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_hidden($item);
					}
					self::_div_item($have_condition);
					break;

				case 'postalcode':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_postalcode($item);
					}
					self::_div_item($have_condition);

					break;

				case 'manual_amount':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_manual_amount($item);
					}
					self::_div_item($have_condition);

					break;

				case 'list_amount':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_list_amount($item);
					}
					self::_div_item($have_condition);

					break;

				case 'amount_suggestion':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_amount_suggestion($item);
					}
					self::_div_item($have_condition);

					break;

				case 'amount_with_coefficient':
					self::div_item($have_condition, 'c-xs-12 c-12');
					{
						self::html_input_amount_with_coefficient($item);
					}
					self::_div_item($have_condition);

					break;


				case 'hidden_amount':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_hidden_amount($item);
					}
					self::_div_item($have_condition);
					break;

				case 'hiddenurl':
					self::div_item($have_condition, 'c-xs-12 c-6');
					{
						self::html_input_hiddenurl($item);
					}
					self::_div_item($have_condition);
					break;


				default:
					# code...
					break;
			}
		}
		self::_div();


		return self::$html;

	}


	private static function check_schedule($_form_id)
	{
		if($_form_id && is_numeric($_form_id))
		{
			$load_form = \lib\db\form\get::by_id($_form_id);
		}
		else
		{
			return true;
		}

		if(isset($load_form['starttime']) && $load_form['starttime'])
		{
			if(time() < strtotime($load_form['starttime']))
			{
				$html = '';

				$html .= '<div class="alert-warning font-bold text-center">';
				{
					$html .= T_("Can not answer to this form at this time") . '<br>';
					$html .= T_("This form will be activated in :date", ['date' => \dash\fit::date_time($load_form['starttime'])]);

					if(a($load_form, 'setting'))
					{
						$setting = json_decode($load_form['setting'], true);
						if(isset($setting['beforestart']))
						{
							$html .= ' <br>' . $setting['beforestart'];
						}
					}
				}
				$html .= '</div>';

				self::$schedule_message = $html;

				return false;
			}
		}


		if(isset($load_form['endtime']) && $load_form['endtime'])
		{
			if(time() > strtotime($load_form['endtime']))
			{
				$html = '';

				$html .= '<div class="alert-warning font-bold text-center">';
				{
					$html .= T_("Can not answer to this form at this time") . '<br>';
					$html .= T_("This form has been active until :date", ['date' => \dash\fit::date_time($load_form['endtime'])]);

					if(a($load_form, 'setting'))
					{
						$setting = json_decode($load_form['setting'], true);
						if(isset($setting['afterend']))
						{
							$html .= ' <br>' . $setting['afterend'];
						}
					}
				}
				$html .= '</div>';


				self::$schedule_message = $html;

				return false;
			}
		}

		return true;
	}


	private static function div_item($have_condition, $class = null)
	{
		if($have_condition)
		{
			$class = 'c-xs-12 c-12';
		}

		if($class)
		{
			self::$html .= '<div class="' . $class . '">';
		}
		else
		{
			self::$html .= '<div>';
		}

		if($have_condition)
		{
			self::$html .= $have_condition;
		}
	}


	private static function _div_item($have_condition)
	{
		self::$html .= '</div>';
		if($have_condition)
		{
			self::$html .= '</div>';
		}
	}


	private static function div($class = null)
	{
		if($class)
		{
			self::$html .= '<div class="' . $class . '">';
		}
		else
		{
			self::$html .= '<div>';
		}
	}


	private static function _div()
	{
		self::$html .= '</div>';
	}


	private static function isDeleted($value)
	{
		if(a($value, 'status') === 'deleted')
		{
			self::$html .= ' <small class="text-red-800">(' . T_("Deleted") . ')</small>';
		}

		if(a($value, 'hidden'))
		{
			self::$html .= ' <small class="text-gray-500"> /* ' . T_("Hidden") . ' */ </small>';
		}
	}


	private static function isRequired($value, $_html = false)
	{
		if(a($value, 'require'))
		{
			if($_html)
			{
				self::$html .= ' <small class="text-red-800">* ' . T_("Required") . '</small>';
			}
			else
			{
				// self::$html .= ' required';
			}
		}
	}


	private static function HtmlDesc($value)
	{
		if(a($value, 'desc'))
		{
			self::$html .= ' <div class="text-gray-400 mb-4 text-sm">' . a($value, 'desc') . '</div> ';
		}
	}


	private static function myName($value, $_return = false)
	{
		$myName = 'a_' . a($value, 'id');

		if($_return)
		{
			return $myName;
		}
		else
		{
			self::$html .= $myName;
		}
	}


	private static function myID($value, $_return = false)
	{
		$myID = 'id_answer_' . a($value, 'id');

		if($_return)
		{
			return $myID;
		}
		else
		{
			self::$html .= $myID;
		}
	}


	private static function HtmlPlaceholder($value, $_select_mode = false, $_special = null)
	{
		if(isset($value['type']) && isset($value['setting'][$value['type']]['placeholder']) && $value['setting'][$value['type']]['placeholder'] && is_string($value['setting'][$value['type']]['placeholder']))
		{
			if($_select_mode)
			{
				self::$html .= $value['setting'][$value['type']]['placeholder'];
			}
			else
			{
				self::$html .= ' placeholder="' . $value['setting'][$value['type']]['placeholder'] . '"';
			}
		}
		else
		{
			if($_select_mode)
			{
				if($_special)
				{
					self::$html .= $_special;
				}
				else
				{
					self::$html .= T_("Please select one item");
				}
			}
		}
	}


	private static function HtmlMin($value)
	{
		if(isset($value['type']) && isset($value['setting'][$value['type']]['min']) && $value['setting'][$value['type']]['min'] && is_numeric($value['setting'][$value['type']]['min']))
		{
			self::$html .= ' min="' . $value['setting'][$value['type']]['min'] . '"';
		}
	}


	private static function HtmlValue($value, $_raw = false)
	{
		if(isset($value['user_answer'][0]['answer']) && is_string($value['user_answer'][0]['answer']))
		{
			if($_raw)
			{
				self::$html .= $value['user_answer'][0]['answer'];
			}
			else
			{
				self::$html .= ' value="' . $value['user_answer'][0]['answer'] . '"';
			}
		}
		else
		{
			if(isset($value['type']) && isset($value['setting'][$value['type']]['defaultvalue']) && is_numeric($value['setting'][$value['type']]['defaultvalue']))
			{

				self::$html .= ' value="' . $value['setting'][$value['type']]['defaultvalue'] . '"';
			}
		}
	}


	private static function HtmlMax($value)
	{
		if(isset($value['type']) && isset($value['setting'][$value['type']]['max']) && $value['setting'][$value['type']]['max'] && is_numeric($value['setting'][$value['type']]['max']))
		{
			self::$html .= ' max="' . $value['setting'][$value['type']]['max'] . '"';
		}
	}


	private static function HtmlMaxLen($value)
	{
		if(isset($value['maxlen']) && is_numeric($value['maxlen']))
		{
			self::$html .= ' maxlength="' . $value['maxlen'] . '"';
		}
	}


	private static function label($value, $_special_text = null, $_special_id = null)
	{

		self::$html .= '<label class="q" for="';
		if($_special_id)
		{
			self::$html .= $_special_id;
		}
		else
		{
			self::myID($value);
		}
		self::$html .= '">';
		{
			if($_special_text)
			{
				self::$html .= $_special_text;
			}
			else
			{
				self::$html .= a($value, 'title');
			}
			self::isRequired($value, true);
		}
		self::isDeleted($value);
		self::$html .= '</label>';
	}


	private static function label_raw($value)
	{
		self::$html .= '<label class="q">';
		self::$html .= a($value, 'title');
		self::isRequired($value, true);
		self::isDeleted($value);
		self::$html .= '</label>';
	}


	private static function label_checkbox($value, $_special_text = null, $_special_id = null)
	{
		self::$html .= '<label for="';
		if($_special_id)
		{
			self::$html .= $_special_id;
		}
		else
		{
			self::myID($value);
		}
		self::$html .= '">';
		{
			if($_special_text)
			{
				self::$html .= $_special_text;
			}
			else
			{
				self::$html .= a($value, 'title');
			}
		}
		self::isDeleted($value);
		self::$html .= '</label>';
	}


	private static function input($type, $value, $_meta = null, $_addons = null)
	{
		self::$html .= '<div class="input">';
		{
			self::$html .= '<input type="' . $type . '" name="';
			self::myName($value);
			self::$html .= '" id="';
			self::myID($value);
			self::$html .= '" ';
			self::isRequired($value);
			self::HtmlPlaceholder($value);
			self::HtmlMaxLen($value);
			self::HtmlMin($value);
			self::HtmlMax($value);
			self::HtmlValue($value);
			self::$html .= $_meta;
			self::$html .= '>';
		}
		if($_addons)
		{
			self::$html .= $_addons;
		}

		self::$html .= '</div>';

	}


	private static function input_raw($type, $value, $_name, $_id, $_meta = null)
	{
		self::$html .= '<input type="' . $type . '" name="' . $_name . '" id="' . $_id . '"';
		self::isRequired($value);
		self::HtmlPlaceholder($value);
		self::HtmlMaxLen($value);
		self::HtmlMin($value);
		self::HtmlMax($value);

		if(strpos(strval($_meta), 'value=') === false)
		{
			self::HtmlValue($value);
		}


		self::$html .= $_meta;
		self::$html .= '>';
	}


	/**
	 * ---------------------------------- INPUT function ---------------------------------
	 */

	private static function html_input_short_answer($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('text', $value);
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_descriptive_answer($value)
	{
		$rows = 2;
		if(isset($value['maxlen']) && is_numeric($value['maxlen']))
		{
			if($value['maxlen'] > 1000)
			{
				$rows = 5;
			}
		}

		// self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label($value);
				self::$html .= '<textarea class="txt" rows="' . $rows . '" ';
				self::$html .= ' id="';
				self::myID($value);
				self::$html .= '" name="';
				self::myName($value);
				self::$html .= '" ';
				self::isRequired($value);
				self::HtmlPlaceholder($value);
				self::HtmlMaxLen($value);
				self::$html .= '>';
				self::HtmlValue($value, true);
				self::$html .= '</textarea>';
				self::HtmlDesc($value);
			}
			self::_div();
		}
		// self::_div();

	}


	private static function html_input_displayname($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('text', $value);
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_manual_amount($value, $_lable = true)
	{
		// self::div('c-xs-12 c-6');
		{
			$addons = '';
			$addons .= '<label for="' . self::myID($value, true) . '"';
			$addons .= ' class="addon">';
			$addons .= \lib\store::currency();
			$addons .= '</label>';

			if($_lable)
			{
				self::label($value);
			}
			self::input('tel', $value, ' data-format="price" data-response-realtime ', $addons);

			// if(\dash\language::current() === 'fa')
			// {
			// 	self::$html .= '<div class="alert-info" ';
			// 	self::$html .= 'data-response="'. self::myName($value, true). '"  data-response-call="wordifyResponse"></div>';
			// }

			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_numeric($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="price" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_single_choice($value)
	{
		// self::div('c-sm-12 c-12');
		{
			self::div('mB10');
			{
				self::label_raw($value);

				self::div('row');
				{
					if(isset($value['choice']) && is_array($value['choice']))
					{
						foreach ($value['choice'] as $k => $v)
						{
							self::div('c-xs-12 c-sm-12');
							{
								self::div('radio3');
								{
									$checked = '';
									if(is_array(a($value, 'user_answer')))
									{
										if(in_array($k, array_column($value['user_answer'], 'choice_id')))
										{
											$checked = ' checked';
										}
									}

									self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true) . $k, ' value="' . a($v, 'title') . '" ' . $checked);
									self::label_checkbox($value, a($v, 'title'), self::myID($value, true) . $k);
								}
								self::_div();
							}
							self::_div();
						}
					}
				}
				self::_div();
			}
			self::HtmlDesc($value);
			self::_div();
		}
		// self::_div();

	}


	private static function html_input_multiple_choice($value)
	{
		// self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label_raw($value);
				self::div('row');
				{
					if(isset($value['choice']) && is_array($value['choice']))
					{
						foreach ($value['choice'] as $k => $v)
						{
							self::div('c-xs-12 c-sm-12');
							{
								self::div('check1');
								{
									$checked = '';
									if(is_array(a($value, 'user_answer')))
									{
										if(in_array($k, array_column($value['user_answer'], 'choice_id')))
										{
											$checked = ' checked';
										}
									}

									self::input_raw('checkbox', $value, self::myName($value, true) . '[]', self::myID($value, true) . $k, ' value="' . a($v, 'title') . '" ' . $checked);
									self::label_checkbox($value, a($v, 'title'), self::myID($value, true) . $k);
								}
								self::_div();
							}
							self::_div();
						}
					}

				}
				self::_div();
			}
			self::HtmlDesc($value);
			self::_div();
		}
		// self::_div();
	}


	private static function html_input_list_amount($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label_raw($value);
			self::div('mB10');
			{
				self::$html .= '<select class="select22" id="';
				self::myID($value);
				self::$html .= '" name="';
				self::myName($value);
				self::$html .= '" data-placeholder="';
				self::HtmlPlaceholder($value, true);
				self::$html .= '">';
				{
					self::$html .= '<option value="">';
					self::HtmlPlaceholder($value, true);
					self::$html .= '</option>';
					if(isset($value['choice']) && is_array($value['choice']))
					{
						foreach ($value['choice'] as $k => $v)
						{
							$selected = '';
							if(floatval(a($v, 'price')) === floatval(a($value, 'user_answer', 0, 'answer')))
							{
								$selected = ' selected';
							}

							self::$html .= '<option value="' . round(floatval(a($v, 'price'))) . '"' . $selected . '>' . a($v, 'title') . '</option>';
						}
					}
				}
				self::$html .= '</select>';
			}
			self::HtmlDesc($value);
			self::_div();
		}
		// self::_div();
	}


	private static function html_input_amount_suggestion($value)
	{
		// self::div('c-xs-12 c-6');
		{
			// self::label_raw($value);

			self::div('mB10');
			{
				self::$html .= '<div class="row mt-2">';
				{
					if(isset($value['choice']) && is_array($value['choice']))
					{
						foreach ($value['choice'] as $k => $v)
						{
							$myPrice = round(floatval(a($v, 'price')));
							$myTitle = a($v, 'title');

							self::$html .= '<div class="c bg-green-100 mx-1 rounded text-center">';
							{
								self::$html .= '<span class="bg-green-100">';
								{
									self::$html .= $myTitle;

								}
								self::$html .= '</span>';
							}
							self::$html .= '</div>';
						}
					}
				}
				self::$html .= '</div>';

				self::html_input_manual_amount($value);
			}
			self::HtmlDesc($value);
			self::_div();
		}
		// self::_div();
	}


	private static function html_input_amount_with_coefficient($value)
	{
		// self::div('c-xs-12 c-6');
		{
			// self::label_raw($value);

			self::div('mB10');
			{
				$coefficient = a($value, 'setting', 'amount_with_coefficient', 'coefficient');

				$myName     = self::myName($value, true);
				$myId       = self::myID($value, true);

				self::label($value);
				self::$html .= '<div class="input">';
				{
					self::$html .= '<lable class="addon" for="' . $myId . '">+</lable>';
					self::input_raw('tel', '', $myName, $myId, ' data-format="price" ');
					self::$html .= '<lable class="addon" for="' . $myId . '">-</lable>';

				}
				self::$html .= '</div>';

			}
			self::HtmlDesc($value);
			self::_div();
		}
		// self::_div();
	}


	private static function html_input_dropdown($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label_raw($value);
			self::div('mB10');
			{
				self::$html .= '<select class="select22" id="';
				self::myID($value);
				self::$html .= '" name="';
				self::myName($value);
				self::$html .= '" data-placeholder="';
				self::HtmlPlaceholder($value, true);
				self::$html .= '">';
				{
					self::$html .= '<option value="">';
					self::HtmlPlaceholder($value, true);
					self::$html .= '</option>';
					if(isset($value['choice']) && is_array($value['choice']))
					{
						foreach ($value['choice'] as $k => $v)
						{
							$selected = '';
							if(is_array(a($value, 'user_answer')))
							{
								if(in_array($k, array_column($value['user_answer'], 'choice_id')))
								{
									$selected = ' selected';
								}
							}

							self::$html .= '<option value="' . a($v, 'title') . '"' . $selected . '>' . a($v, 'title') . '</option>';
						}
					}
				}
				self::$html .= '</select>';
			}
			self::HtmlDesc($value);
			self::_div();
		}
		// self::_div();
	}


	private static function html_input_date($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="date" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_birthdate($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="date" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_country($value)
	{
		// self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label($value);
				self::$html .= \dash\utility\location::countrySelectorHtml(a($value, 'user_answer', 0, 'answer'), null, self::myName($value, true), self::myID($value, true));
				self::HtmlDesc($value);
			}
			self::_div();
		}
		// self::_div();
	}


	private static function html_input_province($value)
	{
		// self::div('c-xs-12 c-12');
		{
			self::label($value);
			self::$html .= \dash\utility\location::provinceSelectorHtml('IR', a($value, 'user_answer', 0, 'answer'), null, self::myName($value, true), self::myID($value, true));
			self::HtmlDesc($value);
		}
		// self::_div();

	}


	private static function html_input_province_city($value)
	{
		// self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label($value);
				self::div();
				{
					self::$html .= \dash\utility\location::provinceSelectorHtml('IR', substr(strval(a($value, 'user_answer', 0, 'answer')), 0, 5), substr(strval(a($value, 'user_answer', 0, 'answer')), 6), self::myName($value, true) . '[]', self::myID($value, true), self::myName($value, true) . '[]', self::myID($value, true) . '_city');
				}
				self::_div();

				self::div();
				{
					self::$html .= \dash\utility\location::citySelectorHtml(substr(strval(a($value, 'user_answer', 0, 'answer')), 6), self::myName($value, true) . '[]', self::myID($value, true) . '_city');
				}
				self::_div();

				self::HtmlDesc($value);
			}
			self::_div();
		}
		// self::_div();

	}


	private static function html_input_gender($value)
	{
		// self::div('c-xs-12 c-12');
		{
			self::label_raw($value);
			self::div('mB10');
			{
				self::div('row');
				{
					self::div('c-xs-12 c-sm-6');
					{
						self::div('radio3');
						{
							$checked = '';
							if(a($value, 'user_answer', 0, 'answer') === 'male')
							{
								$checked = ' checked';
							}
							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true) . 'male', ' value="male" ' . $checked);
							self::label_checkbox($value, T_("I'm Male"), self::myID($value, true) . 'male');
						}
						self::_div();
					}
					self::_div();

					self::div('c-xs-12 c-sm-6');
					{
						self::div('radio3');
						{
							$checked = '';
							if(a($value, 'user_answer', 0, 'answer') === 'female')
							{
								$checked = ' checked';
							}

							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true) . 'female', ' value="female" ' . $checked);
							self::label_checkbox($value, T_("I'm Female"), self::myID($value, true) . 'female');
						}
						self::_div();
					}
					self::_div();
				}
				self::_div();

			}
			self::HtmlDesc($value);
			self::_div();
		}
		// self::_div();
	}


	private static function html_input_time($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="time" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_ircard($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="creditCard" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_irshaba($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::div('input');
			{
				self::input_raw('tel', $value, self::myName($value, true), self::myID($value, true), ' data-format2="shaba" ');
			}
			self::_div();
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_tel($value)
	{
		// self::div('c-xs-12 c-12');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="tel" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_nationalcode($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="nationalCode" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_mobile($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="mobile-enter" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_postalcode($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="postalCode" ');
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_email($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('email', $value);
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_website($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('url', $value);
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_password($value)
	{
		// self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('password', $value);
			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_file($value)
	{
		// self::div('c-xs-12 c-12');
		{
			if(isset($value['setting']['file']['accept']))
			{
				$accept = $value['setting']['file']['accept'];
			}
			else
			{
				$accept = "*";
			}

			self::$html .= '<div data-uploader class="mb-2" data-file-max-size="' . \dash\data::maxFileSize() . '" data-name="' . self::myName($value, true) . '" data-ratio-free data-final="#finalImage' . self::myID($value, true) . '">';
			{
				self::$html .= '<input type="file" accept="' . $accept . '" id="' . self::myID($value, true) . '">';
				// T_('Drag &amp; Drop your files or Browse')
				self::label($value);
				self::$html .= '<label for="' . self::myID($value, true) . '"><img id="finalImage' . self::myID($value, true) . '" alt="' . T_("File") . '"></label>';
			}
			self::$html .= '</div>';

			if(a($value, 'user_answer', 0, 'answer'))
			{
				self::$html .= '<div class="row" data-removeElement>';
				{
					self::$html .= '<div class="c-auto">';
					{
						self::$html .= '<a class="btn-secondary" target="_blank" href="' . \lib\filepath::fix($value['user_answer'][0]['answer']) . '">' . T_("Show file") . '</a>';
					}
					self::$html .= '</div>';

					self::$html .= '<div class="c-auto">';
					{
						if(a($value, 'user_answer', 0, 'answer_detail_id'))
						{
							self::$html .= '<div data-confirm data-data=\'{"remove_file":"remove_file","answer_detail_id":"' . $value['user_answer'][0]['answer_detail_id'] . '"}\' class="imageDel">';
							{
								self::$html .= \dash\utility\icon::svg('trash', 'bootstrap', 'red', 'w-4 m-3');
							}
							self::$html .= '</div>';
						}

					}
					self::$html .= '</div>';
				}
				self::$html .= '</div>';


			}

			self::HtmlDesc($value);
		}
		// self::_div();
	}


	private static function html_input_message($value)
	{
		if(isset($value['title']))
		{
			// self::div('c-xs-12 c-12');
			{
				$class = null;
				if(isset($value['setting']['message']['color']) && $value['setting']['message']['color'])
				{
					switch ($value['setting']['message']['color'])
					{
						case 'red':
							$class = 'danger';
							break;
						case 'green':
							$class = 'success';
							break;
						case 'blue':
							$class = 'primary';
							break;
						case 'yellow':
							$class = 'warning';
							break;
						default:
							break;
					}
				}

				$link        = null;
				$targetblank = false;
				if(isset($value['setting']['message']['link']) && $value['setting']['message']['link'])
				{
					$link = $value['setting']['message']['link'];
				}

				if(isset($value['setting']['message']['targetblank']) && $value['setting']['message']['targetblank'])
				{
					$targetblank = $value['setting']['message']['targetblank'];
				}

				self::$html .= '<div class="alert-' . $class . '">';

				if($link)
				{
					self::$html .= '<a href="' . $link . '"';
					if($targetblank)
					{
						self::$html .= ' target="_blank"';
					}
					self::$html .= '>';
				}

				self::$html .= $value['title'];

				if($link)
				{
					self::$html .= '</a>';
				}

				if(isset($value['desc']))
				{
					self::$html .= '<p>' . $value['desc'] . '</p>';
				}
				self::$html .= '</div>';
			}
			// self::_div();
		}
	}


	private static function html_input_agree($value)
	{
		if(isset($value['title']))
		{
			// self::div('c-xs-12 c-12');
			{
				$class = null;
				if(isset($value['setting']['agree']['color']) && $value['setting']['agree']['color'])
				{
					switch ($value['setting']['agree']['color'])
					{
						case 'red':
							$class = 'danger';
							break;
						case 'green':
							$class = 'success';
							break;
						case 'blue':
							$class = 'primary';
							break;
						case 'yellow':
							$class = 'warning';
							break;
						default:
							break;
					}
				}
				self::$html .= '<div class="alert-' . $class . '">';
				if(isset($value['desc']))
				{
					self::$html .= '<p>' . $value['desc'] . '</p>';
				}
				self::$html .= '<div class="check1">';
				{
					$checked = '';
					if(strval(a($value, 'user_answer', 0, 'answer')) === '1')
					{
						$checked = ' checked';
					}

					self::$html .= '<input type="checkbox" name="';
					self::myName($value);
					self::$html .= '" id="';
					self::myID($value);
					self::$html .= '" value="1" ' . $checked . '>';
					self::$html .= '<label for="';
					self::myID($value);
					self::$html .= '">';
					self::$html .= $value['title'];
					self::isDeleted($value);
					self::$html .= '</label>';
				}
				self::$html .= '</div>';
				self::$html .= '</div>';
			}
			// self::_div();
		}
	}


	private static function html_input_yes_no($value)
	{
		// self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label_raw($value);
				self::div('row');
				{
					self::div('c-xs-12 c-sm-6');
					{
						self::div('radio3');
						{
							$checked = '';
							if(a($value, 'user_answer', 0, 'answer') === 'yes')
							{
								$checked = ' checked';
							}

							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true) . 'yes', ' value="yes" ' . $checked);
							self::label_checkbox($value, T_("Yes"), self::myID($value, true) . 'yes');
						}
						self::_div();
					}
					self::_div();

					self::div('c-xs-12 c-sm-6');
					{
						self::div('radio3');
						{
							$checked = '';
							if(a($value, 'user_answer', 0, 'answer') === 'no')
							{
								$checked = ' checked';
							}


							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true) . 'no', ' value="no" ' . $checked);
							self::label_checkbox($value, T_("No"), self::myID($value, true) . 'no');
						}
						self::_div();
					}
					self::_div();
				}
				self::_div();
			}
			self::HtmlDesc($value);
			self::_div();
		}
		// self::_div();
	}


	private static function html_input_hidden($value)
	{
		$my_value = null;
		if(isset($value['setting']['hidden']['defaultvalue']))
		{
			$my_value = $value['setting']['hidden']['defaultvalue'];
		}
		self::$html .= '<input type="hidden" name="' . self::myName($value, true) . '" value="' . $my_value . '">';
	}


	private static function html_input_hiddenurl($value)
	{
		$urlkey = null;
		if(isset($value['setting']['hiddenurl']['urlkey']))
		{
			$urlkey = $value['setting']['hiddenurl']['urlkey'];
		}


		$my_value = null;

		if($urlkey && \dash\request::key_exists($urlkey, 'GET'))
		{
			$my_value = \dash\request::get($urlkey);

			if(isset($value['setting']['hiddenurl']['whitelist']) && is_array($value['setting']['hiddenurl']['whitelist']))
			{
				if(!in_array($my_value, $value['setting']['hiddenurl']['whitelist']))
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
			if(isset($value['setting']['hidden']['defaultvalue']))
			{
				$my_value = $value['setting']['hidden']['defaultvalue'];
			}
		}
		self::$html .= '<input type="hidden" name="' . self::myName($value, true) . '" value="' . $my_value . '">';
	}


	private static function html_input_hidden_amount($value)
	{
		$my_value = null;
		if(isset($value['setting']['hidden_amount']['defaultvalue']))
		{
			$my_value = $value['setting']['hidden_amount']['defaultvalue'];
		}
		self::$html .= '<input type="hidden" name="' . self::myName($value, true) . '" value="' . $my_value . '">';
	}


	private static function generateFinalMessageFromTransaction()
	{
		$html = '';


		if(\dash\request::get('jftoken'))
		{
			$get_msg = \dash\utility\pay\setting::final_msg(\dash\request::get('jftoken'));
			if($get_msg)
			{
				if(isset($get_msg['condition']) && $get_msg['condition'] === 'ok' && isset($get_msg['plus']))
				{
					$type  = 'success';
					$title = T_("Thanks for your payment");
					$desc  = T_("The amount of :val :currency was received", [
						'val'      => \dash\fit::number($get_msg['plus']),
						'currency' => \lib\currency::name(a($get_msg, 'currency')),
					]);
				}
				else
				{
					$type  = 'error';
					$title = T_("Payment unsuccessfull");
					$desc  = null;
				}

				$html .= '<div data-notif="' . $desc . '" data-notif-title="' . $title . '" data-notif-type="' . $type . '" data-notif-icon="person" data-notif-autorun data-alerty></div>';
			}

		}

		return $html;

	}

}

?>