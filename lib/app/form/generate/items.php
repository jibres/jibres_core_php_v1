<?php
namespace lib\app\form\generate;


trait items
{

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

		if(self::formCheckLoginButton())
		{
			return self::$html;
		}

		if(self::checkUniqueSession())
		{
			return self::$html;
		}

		self::timeLimitMessage();

		if(self::formStartButton())
		{
			return self::$html;
		}

		self::div('row');
		foreach ($_items as $item)
		{
			if(!isset($item['type']))
			{
				continue;
			}

			if(!self::randomQuestion($item))
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

			$classC6S12 = 'c-xs-12 c-6';

			if(isset($item['file']) && $item['file'])
			{
				$classC6S12 = 'c-xs-12 c-12';
				self::$html .= \dash\layout\elements\filePreview::byExtension($item['file']);
			}


			switch ($item['type'])
			{
				case 'short_answer':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_short_answer($item);
					}
					self::_div_item($have_condition);

					break;

				case 'displayname':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_displayname($item);
					}
					self::_div_item($have_condition);
					break;

				case 'descriptive_answer':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_descriptive_answer($item);
					}
					self::_div_item($have_condition);

					break;

				case 'numeric':
					self::div_item($have_condition, $classC6S12);
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
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_dropdown($item);
					}
					self::_div_item($have_condition);

					break;

				case 'date':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_date($item);
					}
					self::_div_item($have_condition);

					break;

				case 'birthdate':
					self::div_item($have_condition, $classC6S12);
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
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_time($item);
					}
					self::_div_item($have_condition);

					break;

				case 'ircard':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_ircard($item);
					}
					self::_div_item($have_condition);

					break;

				case 'irshaba':
					self::div_item($have_condition, $classC6S12);
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
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_nationalcode($item);
					}
					self::_div_item($have_condition);

					break;

				case 'mobile':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_mobile($item);
					}
					self::_div_item($have_condition);

					break;

				case 'email':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_email($item);
					}
					self::_div_item($have_condition);

					break;

				case 'website':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_website($item);
					}
					self::_div_item($have_condition);

					break;

				case 'password':
					self::div_item($have_condition, $classC6S12);
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
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_hidden($item);
					}
					self::_div_item($have_condition);
					break;

				case 'postalcode':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_postalcode($item);
					}
					self::_div_item($have_condition);

					break;

				case 'manual_amount':
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_manual_amount($item);
					}
					self::_div_item($have_condition);

					break;

				case 'list_amount':
					self::div_item($have_condition, $classC6S12);
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
					self::div_item($have_condition, $classC6S12);
					{
						self::html_input_hidden_amount($item);
					}
					self::_div_item($have_condition);
					break;

				case 'hiddenurl':
					self::div_item($have_condition, $classC6S12);
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

}
