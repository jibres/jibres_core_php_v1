<?php
namespace dash;
/**
 * Class for clean args
 */
class cleanse
{
	public static function input($_args, $_condition, $_required = [], $_meta = [])
	{
		if(!is_array($_args))
		{
			\dash\notif::error(T_("First Arguments of input function is required!"));
			self::bye();
		}

		if(!$_args)
		{
			\dash\notif::error(T_("First Arguments of input function cannot be empty!"));
			self::bye();
		}

		if(!is_array($_condition))
		{
			\dash\notif::error(T_("Second Arguments of input function is required!"));
			self::bye();
		}

		if(!$_condition)
		{
			\dash\notif::error(T_("Second Arguments of input function cannot be empty!"));
			self::bye();
		}

		if(!is_array($_required))
		{
			\dash\notif::error(T_("Third Arguments of input function must be array!"));
			self::bye();
		}

		if(!is_array($_meta))
		{
			\dash\notif::error(T_("Fourth Arguments of input function must be array!"));
			self::bye();
		}

		$input = $_args;

		$data  = [];


		foreach ($_condition as $field => $validate)
		{
			if(!is_string($field))
			{
				\dash\notif::error(T_("Index of condition arguments must be string!"));
				self::bye();
			}

			// the user not send any request by this name
			if(!array_key_exists($field, $input))
			{
				$data[$field] = null;
				continue;
			}

			$field_title = $field;
			if(isset($_meta['field_title'][$field]) && is_string($_meta['field_title'][$field]))
			{
				$field_title = $_meta['field_title'][$field];
			}


			$myData = $input[$field];

			// to check count of needless arguments
			unset($input[$field]);

			$check = false;

			if(is_string($validate))
			{
				$check = self::data($myData, $validate, true, ['element' => $field, 'field_title' => $field_title]);
			}
			elseif(is_array($validate))
			{
				if(isset($validate['enum']) && is_array($validate['enum']))
				{
					$my_enum = $validate['enum'];
					foreach ($my_enum as $my_enum_item)
					{
						if(!is_string($my_enum_item) && !is_numeric($my_enum_item))
						{
							self::bye(T_("Enum option must be string or number"));
						}
					}
					$check = self::data($myData, 'enum', true, ['enum' => $validate['enum'], 'field_title' => $field_title, 'element' => $field]);
				}
				else
				{
					$temp_data = $myData;

					if(is_array($temp_data))
					{
						foreach ($temp_data as $array_key => $array_validate)
						{

						}
					}
					else
					{
						\dash\notif::error(T_("Field :val must be array", ['val' => $field]));
					}
				}
			}
			else
			{
				\dash\notif::error(T_("Vlidate function must be string or array!"));
				self::bye();
			}

			$data[$field] = $check;

		}

		if(count($input) >= 1)
		{
			\dash\notif::error(T_("Needless arguments was received!"));
			self::bye();
		}

		if($_required)
		{
			foreach ($_required as $required_field)
			{
				if(!is_string($required_field))
				{
					\dash\notif::error(T_("Arguments of required field must be string!"));
					continue;
				}

				if($required_field === '')
				{
					\dash\notif::error(T_("Arguments of required field cannot be empty string!"));
					continue;
				}


				if(!array_key_exists($required_field, $_condition))
				{
					\dash\notif::error(T_("Field :val is required but not set in condition args!", ['val' => $required_field]));
					continue;
				}

				if(!$data[$required_field] && $data[$required_field] !== 0)
				{
					\dash\notif::error(T_("Field :val is required", ['val' => $required_field]), ['code' => 1500, 'element' => $required_field]);
				}
			}
		}

		if(!\dash\engine\process::status())
		{
			self::bye();
		}

		return $data;
	}



	public static function data($_data, $_cleans_function, $_notif = false, $_meta = [])
	{
		if(!$_cleans_function)
		{
			self::bye(T_("Validate function is required!"));
		}

		if(!is_string($_cleans_function))
		{
			self::bye(T_("Validate function must be string!"));
		}

		if(mb_strlen($_cleans_function) > 50)
		{
			self::bye(T_("Validate function is too long!"));
		}

		if(!is_array($_meta))
		{
			self::bye(T_("Fourth arguments of function data must be array!"));
		}

		$function    = $_cleans_function;
		$max         = null;
		$min         = null;
		$data        = null;
		$element     = null;
		$field_title = null;

		if(isset($_meta['element']) && is_string($_meta['element']))
		{
			$element = $_meta['element'];
		}

		if(isset($_meta['field_title']) && is_string($_meta['field_title']))
		{
			$field_title = $_meta['field_title'];
		}

		if(strpos($function, '_') !== false)
		{
			$explode = explode('_', $function);
			if(isset($explode[0]))
			{
				$function = $explode[0];
			}

			if(isset($explode[1]))
			{
				$max = $explode[1];
			}

			if(isset($explode[2]))
			{
				$min = $explode[2];
			}
		}

		if($max && !is_numeric($max))
		{
			self::bye(T_("Second part of string function must be a number!"));
		}

		if($max && mb_strlen($max) > 10)
		{
			self::bye(T_("Second part of string function must be less than 10 character!"));
		}

		if($max && intval($max) <= 0)
		{
			self::bye(T_("Second part of string function must be larger than zero!"));
		}

		if($min && !is_numeric($min))
		{
			self::bye(T_("Second part of string function must be a number!"));
		}

		if($min && mb_strlen($min) > 10)
		{
			self::bye(T_("Second part of string function must be less than 10 character!"));
		}

		if($min && intval($min) <= 0)
		{
			self::bye(T_("Second part of string function must be larger than zero!"));
		}

		$meta = $_meta;
		if($max)
		{
			$meta['max'] = $max;
		}

		if($min)
		{
			$meta['min'] = $min;
		}

		switch ($function)
		{
			case 'price':
				$data = \dash\validate\number::price($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'mobile':
				$data = \dash\validate\mobile::mobile($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'ir_mobile':
				$data = \dash\validate\mobile::ir_mobile($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'string':
				$data = \dash\validate\text::string($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'address':
				$data = \dash\validate\text::address($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'title':
				$data = \dash\validate\text::title($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'html':
				$data = \dash\validate\text::html($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'desc':
				$data = \dash\validate\text::desc($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'username':
				$data = \dash\validate\text::username($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'password':
				$data = \dash\validate\password::password($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'enum':
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'order':
				$meta['enum'] = ['asc', 'desc'];
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'number':
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;

			default:
				self::bye(T_("Invalid vaidate function".' '. $function));
				break;
		}


		return $data;
	}




	private static function bye($_msg = null)
	{
		j($_msg);
		\dash\header::status(400, $_msg);
	}
}
?>