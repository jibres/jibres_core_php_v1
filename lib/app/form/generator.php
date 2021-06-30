<?php
namespace lib\app\form;


class generator
{
	private static $html = '';


	public static function shipping_survey($_form_id)
	{
		$load_form = \lib\app\form\form\get::public_get($_form_id);

		if(!$load_form)
		{
			return null;
		}

		$load_items = \lib\app\form\item\get::items($_form_id);

		self::$html .= '<div class="box">';
		{
			self::$html .= '<div class="pad" >';
			{
				self::$html .= '<input type="hidden" name="startdate" value="'. date("Y-m-d H:i:s"). '">';
				self::$html .= '<input type="hidden" name="answerform" value="answerform">';

				if(a($load_form, 'file'))
				{
					self::$html .= '<img class="mB10" src="'. a($load_form, 'file'). '" alt="'. a($load_form, 'title'). '">';
				}
				if(a($load_form, 'desc'))
				{
					self::$html .= '<div class="mB20">'. a($load_form, 'desc'). '</div>';
				}

				\lib\app\form\generator::items($load_items);
			}
			self::$html .= '</div>';
		}
		self::$html .= '</div>';


		return self::$html;
	}

	public static function full_html($_form_id)
	{
		$load_form = \lib\app\form\form\get::public_get($_form_id);

		if(!$load_form)
		{
			return null;
		}

		$load_items = \lib\app\form\item\get::items($_form_id);

		self::$html .= '<form method="post" autocomplete="off">';
		{
			self::$html .= '<div class="">';
			{

				self::$html .= '<div class="box">';
				{
					self::$html .= '<header class="c-xs-0"><h2>'. a($load_form, 'title'). '</h2></header>';
					self::$html .= '<div class="body" data-jform>';
					{
						self::$html .= '<input type="hidden" name="startdate" value="'. date("Y-m-d H:i:s"). '">';
						self::$html .= '<input type="hidden" name="answerform" value="answerform">';

						if(a($load_form, 'file'))
						{
							self::$html .= '<img class="mB10" src="'. a($load_form, 'file'). '" alt="'. a($load_form, 'title'). '">';
						}
						if(a($load_form, 'desc'))
						{
							self::$html .= '<div class="mB20">'. a($load_form, 'desc'). '</div>';
						}

						\lib\app\form\generator::items($load_items);
					}
					self::$html .= '</div>';

					self::$html .= '<footer class="txtRa">';
					{
						self::$html .= '<button class="btn master">'. T_("Submit"). '</button>';
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

		self::div('row');
		foreach ($_items as $item)
		{
			if(!isset($item['type']))
			{
				continue;
			}

			switch ($item['type'])
			{
				case 'short_answer':		self::html_input_short_answer($item);break;
				case 'displayname':			self::html_input_displayname($item);break;
				case 'descriptive_answer':	self::html_input_descriptive_answer($item);break;
				case 'numeric':				self::html_input_numeric($item);break;
				case 'single_choice':		self::html_input_single_choice($item);break;
				case 'multiple_choice':		self::html_input_multiple_choice($item);break;
				case 'dropdown':			self::html_input_dropdown($item);break;
				case 'date':				self::html_input_date($item);break;
				case 'birthdate':			self::html_input_birthdate($item);break;
				case 'country':				self::html_input_country($item);break;
				case 'province':			self::html_input_province($item);break;
				case 'province_city':		self::html_input_province_city($item);break;
				case 'gender':				self::html_input_gender($item);break;
				case 'time':				self::html_input_time($item);break;
				case 'tel':					self::html_input_tel($item);break;
				case 'file':				self::html_input_file($item);break;
				case 'nationalcode':		self::html_input_nationalcode($item);break;
				case 'mobile':				self::html_input_mobile($item);break;
				case 'email':				self::html_input_email($item);break;
				case 'website':				self::html_input_website($item);break;
				case 'password':			self::html_input_password($item);break;
				case 'yes_no':				self::html_input_yes_no($item);break;
				case 'message':				self::html_input_message($item);break;
				case 'agree':				self::html_input_agree($item);break;
				case 'hidden':				self::html_input_hidden($item);break;
				case 'postalcode':			self::html_input_postalcode($item);break;

				default:
					# code...
					break;
			}
		}
		self::_div();


		return self::$html;

	}


	private static function div($class = null)
	{
		if($class)
		{
			self::$html .= '<div class="'. $class. '">';
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



	private static function isRequired($value, $_html = false)
	{
		if(a($value, 'require'))
		{
			if($_html)
			{
		 		self::$html .= ' <small class="fc-red">* '.  T_("Required"). '</small>';
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
		 	self::$html .= ' <div class="fc-mute mB20 fs09">'.  a($value, 'desc'). '</div> ';
		}
	}


	private static function myName($value, $_return = false)
	{
		$myName = 'a_'. a($value, 'id');

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
		$myID = 'id_answer_'. a($value, 'id');

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
				self::$html .= ' placeholder="'. $value['setting'][$value['type']]['placeholder']. '"';
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
			self::$html .= ' min="'. $value['setting'][$value['type']]['min']. '"';
		}
	}


	private static function HtmlValue($value, $_raw = false)
	{
		if(isset($value['user_answer']) && is_string($value['user_answer']))
		{
			if($_raw)
			{
				self::$html .= $value['user_answer'];
			}
			else
			{
				self::$html .= ' value="'. $value['user_answer']. '"';
			}
		}
	}

	private static function HtmlMax($value)
	{
		if(isset($value['type']) && isset($value['setting'][$value['type']]['max']) && $value['setting'][$value['type']]['max'] && is_numeric($value['setting'][$value['type']]['max']))
		{
			self::$html .= ' max="'. $value['setting'][$value['type']]['max']. '"';
		}
	}

	private static function HtmlMaxLen($value)
	{
		if(isset($value['maxlen']) && is_numeric($value['maxlen']))
		{
			self::$html .= ' maxlength="'. $value['maxlen']. '"';
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
		self::$html .= '</label>';
	}


	private static function label_raw($value)
	{
		self::$html .= '<label class="q">';
		self::$html .= a($value, 'title');
		self::isRequired($value, true);
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
		self::$html .= '</label>';
	}


	private static function input($type, $value, $_meta = null)
	{
		self::$html .= '<div class="input">';
		{
			self::$html .= '<input type="'. $type. '" name="';
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
		self::$html .= '</div>';

	}


	private static function input_raw($type, $value, $_name, $_id, $_meta = null)
	{
		self::$html .= '<input type="'. $type. '" name="'. $_name. '" id="'. $_id. '"';
		self::isRequired($value);
		self::HtmlPlaceholder($value);
		self::HtmlMaxLen($value);
		self::HtmlMin($value);
		self::HtmlMax($value);


		self::$html .= $_meta;
		self::$html .= '>';
	}






	/**
	 * ---------------------------------- INPUT function ---------------------------------
	 */

	private static function html_input_short_answer($value)
	{
		self::div('c-xs-12 c-6');
		{
			self::label($value)	;
			self::input('text', $value);
			self::HtmlDesc($value);
		}
		self::_div();
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

		self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label($value);
				self::$html .= '<textarea class="txt" rows="'. $rows. '" ';
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
		self::_div();

	}



	private static function html_input_displayname($value)
	{
		self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('text', $value);
			self::HtmlDesc($value);
		}
		self::_div();
	}




	private static function html_input_numeric($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="price" ');
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_single_choice($value)
	{
		self::div('c-sm-12 c-12');
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
									self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). $k, ' value="'. a($v, 'title'). '" ');
									self::label_checkbox($value, a($v, 'title'), self::myID($value, true). $k);
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
		self::_div();

	}





	private static function html_input_multiple_choice($value)
	{
		self::div('c-xs-12 c-12');
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
									self::input_raw('checkbox', $value, self::myName($value, true). '[]', self::myID($value, true). $k, ' value="'. a($v, 'title'). '" ');
									self::label_checkbox($value, a($v, 'title'), self::myID($value, true). $k);
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
		self::_div();
	}




	private static function html_input_dropdown($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label_raw($value);
			self::div('mB10');
			{
				self::$html .= '<select class="select22" id="'; self::myID($value); self::$html .= '" name="'; self::myName($value); self::$html .= '" data-placeholder="'; self::HtmlPlaceholder($value, true); self::$html .= '">';
				{
					self::$html .= '<option value="">'; self::HtmlPlaceholder($value, true); self::$html .= '</option>';
					if(isset($value['choice']) && is_array($value['choice']))
					{
						foreach ($value['choice'] as $k => $v)
						{
							self::$html .= '<option value="'. a($v, 'title'). '">'. a($v, 'title'). '</option>';
						}
					}
				}
				self::$html .= '</select>';
			}
			self::HtmlDesc($value);
			self::_div();
		}
		self::_div();
	}


	private static function html_input_date($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('text', $value, ' data-format="date" ');
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_birthdate($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('text', $value, ' data-format="date" ');
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_country($value)
	{
		self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label($value);
				self::$html .= \dash\utility\location::countrySelectorHtml(null, null, self::myName($value, true), self::myID($value, true));
				self::HtmlDesc($value);
			}
			self::_div();
		}
		self::_div();
	}


	private static function html_input_province($value)
	{
		self::div('c-xs-12 c-12');
		{
			self::label($value);
			self::$html .= \dash\utility\location::provinceSelectorHtml('IR', null, null, self::myName($value, true), self::myID($value, true));
			self::HtmlDesc($value);
		}
		self::_div();

	}



	private static function html_input_province_city($value)
	{
		self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label($value);
				self::div();
				{
					self::$html .= \dash\utility\location::provinceSelectorHtml('IR', null, null, self::myName($value, true). '[]', self::myID($value, true), self::myName($value, true). '[]', self::myID($value, true). '_city');
				}
				self::_div();

				self::div();
				{
					self::$html .= \dash\utility\location::citySelectorHtml(null, self::myName($value, true). '[]', self::myID($value, true). '_city');
				}
				self::_div();

				self::HtmlDesc($value);
			}
			self::_div();
		}
		self::_div();

	}


	private static function html_input_gender($value)
	{
		self::div('c-xs-12 c-12');
		{
			self::label_raw($value);
			self::div('mB10');
			{
				self::div('row');
				{
					self::div('c-xs-6 c-sm-6');
					{
						self::div('radio3');
						{
							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). 'male', ' value="male" ');
							self::label_checkbox($value, T_("I'm Male"), self::myID($value, true). 'male');
						}
						self::_div();
					}
					self::_div();

					self::div('c-xs-6 c-sm-6');
					{
						self::div('radio3');
						{
							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). 'female', ' value="female" ');
							self::label_checkbox($value, T_("I'm Female"), self::myID($value, true). 'female');
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
		self::_div();
	}


	private static function html_input_time($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="time" ');
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_tel($value)
	{
		self::div('c-xs-12 c-12');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="tel" ');
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_nationalcode($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="nationalCode" ');
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_mobile($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="mobile-enter" ');
			self::HtmlDesc($value);
		}
		self::_div();
	}



	private static function html_input_postalcode($value)
	{
		self::div('c-xs-12 c-6');
		{
			self::label($value);
			self::input('tel', $value, ' data-format="postalCode" ');
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_email($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('email', $value);
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_website($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('url', $value);
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_password($value)
	{
		self::div('c-xs-6 c-6');
		{
			self::label($value);
			self::input('password', $value);
			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_file($value)
	{
		self::div('c-xs-12 c-12');
		{
			if(isset($value['setting']['file']['accept']))
			{
				$accept = $value['setting']['file']['accept'];
			}
			else
			{
				$accept = "*";
			}

			self::$html .= '<div data-uploader data-file-max-size="'. \dash\data::maxFileSize() .'" data-name="'. self::myName($value, true). '" data-ratio-free data-final="#finalImage'. self::myID($value, true). '">';
			{
				self::$html .= '<input type="file" accept="'. $accept.  '" id="'. self::myID($value, true). '">';
				// T_('Drag &amp; Drop your files or Browse')
				self::label($value);
				self::$html .= '<label for="'. self::myID($value, true). '"><img id="finalImage'. self::myID($value, true). '" alt="'. T_("File"). '"></label>';
			}
			self::$html .= '</div>';

			self::HtmlDesc($value);
		}
		self::_div();
	}


	private static function html_input_message($value)
	{
		if(isset($value['title']))
		{
			self::div('c-xs-12 c-12');
			{
				$class = null;
				if(isset($value['setting']['message']['color']) && $value['setting']['message']['color'])
				{
					switch ($value['setting']['message']['color'])
					{
						case 'red':		$class = 'danger2'; break;
						case 'green':	$class = 'success2'; break;
						case 'blue':	$class = 'primary2'; break;
						case 'yellow':	$class = 'warn2'; break;
						default: break;
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

				self::$html .= '<div class="msg '. $class .'">';

				if($link)
				{
					self::$html .= '<a href="'. $link. '"';
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
					self::$html .= '<p>'. $value['desc'] .'</p>';
				}
				self::$html .= '</div>';
			}
			self::_div();
		}
	}



	private static function html_input_agree($value)
	{
		if(isset($value['title']))
		{
			self::div('c-xs-12 c-12');
			{
				if(isset($value['setting']['agree']['color']) && $value['setting']['agree']['color'])
				{
					$class = null;
					switch ($value['setting']['agree']['color'])
					{
						case 'red':		$class = 'danger2'; break;
						case 'green':	$class = 'success2'; break;
						case 'blue':	$class = 'primary2'; break;
						case 'yellow':	$class = 'warn2'; break;
						default: break;
					}
				}
				self::$html .= '<div class="msg '. $class .'">';
					if(isset($value['desc']))
					{
						self::$html .= '<p>'. $value['desc'] .'</p>';
					}
					self::$html .= '<div class="check1">';
						self::$html .= '<input type="checkbox" name="'; self::myName($value); self::$html .= '" id="'; self::myID($value); self::$html .= '" value="1">';
						self::$html .= '<label for="'; self::myID($value); self::$html .= '">'. $value['title'].'</label>';
					self::$html .= '</div>';
				self::$html .= '</div>';
			}
			self::_div();
		}
	}



	private static function html_input_yes_no($value)
	{
		self::div('c-xs-12 c-12');
		{
			self::div('mB10');
			{
				self::label_raw($value);
				self::div('row');
				{
					self::div('c-xs-6 c-sm-6');
					{
						self::div('radio3');
						{
							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). 'yes', ' value="yes" ');
							self::label_checkbox($value, T_("Yes"), self::myID($value, true). 'yes');
						}
						self::_div();
					}
					self::_div();

					self::div('c-xs-6 c-sm-6');
					{
						self::div('radio3');
						{
							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). 'no', ' value="no" ');
							self::label_checkbox($value, T_("No"), self::myID($value, true). 'no');
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
		self::_div();
	}


	private static function html_input_hidden($value)
	{
		$my_value = null;
		if(isset($value['setting']['hidden']['defaultvalue']))
		{
			$my_value = $value['setting']['hidden']['defaultvalue'];
		}
		self::$html .= '<input type="hidden" name="'. self::myName($value, true). '" value="'. $my_value. '">';
	}

}
?>