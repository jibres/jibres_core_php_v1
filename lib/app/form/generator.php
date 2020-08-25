<?php
namespace lib\app\form;


class generator
{
	public static function items($_items)
	{
		if(!$_items || !is_array($_items))
		{
			return;
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

				default:
					# code...
					break;
			}
		}
		self::_div();

	}


	private static function div($class = null)
	{
		if($class)
		{
			echo '<div class="'. $class. '">';
		}
		else
		{
			echo '<div>';
		}
	}


	private static function _div()
	{
		echo '</div>';
	}



	private static function isRequired($value, $_html = false)
	{
		if(\dash\get::index($value, 'require'))
		{
			if($_html)
			{
		 		echo ' <small class="fc-red">* '.  T_("Required"). '</small>';
			}
			else
			{
				// echo ' required';
			}
		}
	}


	private static function HtmlDesc($value)
	{
		if(\dash\get::index($value, 'desc'))
		{
		 	echo ' <div class="fc-mute mB20 fs09">'.  \dash\get::index($value, 'desc'). '</div> ';
		}
	}


	private static function myName($value, $_return = false)
	{
		$myName = 'answer_'. \dash\get::index($value, 'id');

		if($_return)
		{
			return $myName;
		}
		else
		{
			echo $myName;
		}
	}


	private static function myID($value, $_return = false)
	{
		$myID = 'id_answer_'. \dash\get::index($value, 'id');

		if($_return)
		{
			return $myID;
		}
		else
		{
			echo $myID;
		}
	}


	private static function HtmlPlaceholder($value, $_select_mode = false, $_special = null)
	{
		if(isset($value['type']) && isset($value['setting'][$value['type']]['placeholder']) && $value['setting'][$value['type']]['placeholder'] && is_string($value['setting'][$value['type']]['placeholder']))
		{
			if($_select_mode)
			{
				echo $value['setting'][$value['type']]['placeholder'];
			}
			else
			{
				echo ' placeholder="'. $value['setting'][$value['type']]['placeholder']. '"';
			}
		}
		else
		{
			if($_select_mode)
			{
				if($_special)
				{
					echo $_special;
				}
				else
				{
					echo T_("Please select one item");
				}
			}
		}
	}

	private static function HtmlMin($value)
	{
		if(isset($value['type']) && isset($value['setting'][$value['type']]['min']) && $value['setting'][$value['type']]['min'] && is_numeric($value['setting'][$value['type']]['min']))
		{
			echo ' min="'. $value['setting'][$value['type']]['min']. '"';
		}
	}

	private static function HtmlMax($value)
	{
		if(isset($value['type']) && isset($value['setting'][$value['type']]['max']) && $value['setting'][$value['type']]['max'] && is_numeric($value['setting'][$value['type']]['max']))
		{
			echo ' max="'. $value['setting'][$value['type']]['max']. '"';
		}
	}

	private static function HtmlMaxLen($value)
	{
		if(isset($value['maxlen']) && is_numeric($value['maxlen']))
		{
			echo ' maxlength="'. $value['maxlen']. '"';
		}
	}

	private static function label($value, $_special_text = null, $_special_id = null)
	{
		echo '<label for="';
		if($_special_id)
		{
			echo $_special_id;
		}
		else
		{
			self::myID($value);
		}
		echo '">';
		{
			if($_special_text)
			{
				echo $_special_text;
			}
			else
			{
				echo \dash\get::index($value, 'title');
			}
			self::isRequired($value, true);
		}
		echo '</label>';
	}


	private static function label_raw($value, $_bold = false)
	{
		echo '<label>';
		if($_bold)
		{
			echo '<span class="txtB">';
			echo \dash\get::index($value, 'title');
			echo '</span>';
		}
		else
		{
			echo \dash\get::index($value, 'title');
		}

		self::isRequired($value, true);
		echo '</label>';
	}


	private static function label_checkbox($value, $_special_text = null, $_special_id = null)
	{
		echo '<label for="';
		if($_special_id)
		{
			echo $_special_id;
		}
		else
		{
			self::myID($value);
		}
		echo '">';
		{
			if($_special_text)
			{
				echo $_special_text;
			}
			else
			{
				echo \dash\get::index($value, 'title');
			}
		}
		echo '</label>';
	}


	private static function input($type, $value, $_meta = null)
	{
		echo '<div class="input">';
		{
			echo '<input type="'. $type. '" name="';
			self::myName($value);
			echo '" id="';
			self::myID($value);
			echo '" ';
			self::isRequired($value);
			self::HtmlPlaceholder($value);
			self::HtmlMaxLen($value);
			echo $_meta;
			echo '>';
		}
		echo '</div>';

	}


	private static function input_raw($type, $value, $_name, $_id, $_meta = null)
	{
		echo '<input type="'. $type. '" name="'. $_name. '" id="'. $_id. '"';
		self::isRequired($value);
		self::HtmlPlaceholder($value);
		self::HtmlMaxLen($value);
		echo $_meta;
		echo '>';
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
				echo '<textarea class="txt" rows="'. $rows. '" ';
				echo ' id="';
				self::myID($value);
				echo '" name="';
				self::myName($value);
				echo '" ';
				self::isRequired($value);
				self::HtmlPlaceholder($value);
				self::HtmlMaxLen($value);
				echo '></textarea>';
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
				self::label_raw($value, true);

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
									self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). $k, ' value="'. \dash\get::index($v, 'title'). '" ');
									self::label_checkbox($value, \dash\get::index($v, 'title'), self::myID($value, true). $k);
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
				self::label_raw($value, true);
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
									self::input_raw('checkbox', $value, self::myName($value, true). '[]', self::myID($value, true). $k, ' value="'. \dash\get::index($v, 'title'). '" ');
									self::label_checkbox($value, \dash\get::index($v, 'title'), self::myID($value, true). $k);
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
				echo '<select class="select22" id="'; self::myID($value); echo '" name="'; self::myName($value); echo '" data-placeholder="'; self::HtmlPlaceholder($value, true); echo '">';
				{
					echo '<option value="">'; self::HtmlPlaceholder($value, true); echo '</option>';
					if(isset($value['choice']) && is_array($value['choice']))
					{
						foreach ($value['choice'] as $k => $v)
						{
							echo '<option value="'. \dash\get::index($v, 'title'). '">'. \dash\get::index($v, 'title'). '</option>';
						}
					}
				}
				echo '</select>';
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
				\dash\utility\location::countrySelectorHtml(null, null, self::myName($value, true), self::myID($value, true));
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
			\dash\utility\location::provinceSelectorHtml('IR', null, null, self::myName($value, true), self::myID($value, true));
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
					\dash\utility\location::provinceSelectorHtml('IR', null, null, self::myName($value, true). '[]', self::myID($value, true), self::myName($value, true). '[]', self::myID($value, true). '_city');
				}
				self::_div();

				self::div();
				{
					\dash\utility\location::citySelectorHtml(null, self::myName($value, true). '[]', self::myID($value, true). '_city');
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
			self::label_raw($value, true);
			self::div('mB10');
			{
				self::div('row');
				{
					self::div('c-xs-12 c-sm-6');
					{
						self::div('radio3');
						{
							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). 'male', ' value="male" ');
							self::label_checkbox($value, T_("I'm Male"), self::myID($value, true). 'male');
						}
						self::_div();
					}
					self::_div();

					self::div('c-xs-12 c-sm-6');
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
		self::div('c-xs-6 c-6');
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

			echo '<div data-uploader data-name="'. self::myName($value, true). '" data-final="#finalImage'. self::myID($value, true). '">';
			{
				echo '<input type="file" accept="'. $accept.  '" id="'. self::myID($value, true). '">';
				self::label($value,T_('Drag &amp; Drop your files or Browse'));
				echo '<label for="'. self::myID($value, true). '"><img id="finalImage'. self::myID($value, true). '" alt="'. T_("File"). '"></label>';
			}
			echo '</div>';

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

				echo '<div class="msg '. $class .'">';

				if($link)
				{
					echo '<a href="'. $link. '"';
					if($targetblank)
					{
						 echo ' target="_blank"';
					}
					echo '>';
				}

				echo $value['title'];

				if($link)
				{
					echo '</a>';
				}

				if(isset($value['desc']))
				{
					echo '<p>'. $value['desc'] .'</p>';
				}
				echo '</div>';
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
				echo '<div class="msg '. $class .'">';
					if(isset($value['desc']))
					{
						echo '<p>'. $value['desc'] .'</p>';
					}
					echo '<div class="check1">';
						echo '<input type="checkbox" name="'; self::myName($value); echo '" id="'; self::myID($value); echo '" value="1">';
						echo '<label for="'; self::myID($value); echo '">'. $value['title'].'</label>';
					echo '</div>';
				echo '</div>';
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
				self::label_raw($value, true);
				self::div('row');
				{
					self::div('c-xs-12 c-sm-6');
					{
						self::div('radio3');
						{
							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). 'yes');
							self::label_checkbox($value, T_("Yes"), self::myID($value, true). 'yes');
						}
						self::_div();
					}
					self::_div();

					self::div('c-xs-12 c-sm-6');
					{
						self::div('radio3');
						{
							self::input_raw('radio', $value, self::myName($value, true), self::myID($value, true). 'no');
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
		echo '<input type="hidden" name="'. self::myName($value, true). '" value="'. $my_value. '">';
	}

}
?>