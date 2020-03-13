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

		if(!is_array($_condition))
		{
			\dash\notif::error(T_("Second Arguments of input function is required!"));
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

			$data[$field] = null;

			// the user not send any request by this name
			if(!array_key_exists($field, $input))
			{
				continue;
			}


			$my_data = $input[$field];

			$field_title = $field;
			if(isset($_meta['field_title'][$field]) && is_string($_meta['field_title'][$field]))
			{
				$field_title = $_meta['field_title'][$field];
			}

			// to check count of needless arguments
			unset($input[$field]);


			$check = null;


			// validation is a string maybe need to call a function
			if(is_string($validate))
			{
				$check = self::data($validate, $my_data, true, ['element' => $field, 'field_title' => $field_title]);
			}
			elseif(is_array($validate))
			{
				// enum mode
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
					$check = self::data('enum', $my_data, true, ['enum' => $validate['enum'], 'field_title' => $field_title, 'element' => $field]);
				}
				elseif(isset($validate['bool']) && is_array($validate['bool']))
				{
					$my_bool = $validate['bool'];
					foreach ($my_bool as $my_bool_item)
					{
						if(!is_string($my_bool_item) && !is_numeric($my_bool_item) && !is_null($my_bool_item) && !is_bool($my_bool_item))
						{
							self::bye(T_("Boolval option must be string or number or null"));
						}
					}

					if(!is_string($my_data) && !is_numeric($my_data) && !is_null($my_data) && !is_bool($my_data))
					{
						\dash\notif::error(T_("Invalid boolval in field :val", ['val' => $field_title]), ['element' => $field]);
						continue;
					}

					if(count($my_bool) !== 2)
					{
						self::bye(T_("Boolval array must be contain exactly 2 option"));
					}

					$my_bool = array_values($my_bool);

					if($my_data)
					{
						$check = $my_bool[0];
					}
					else
					{
						$check = $my_bool[1];
					}
				}
				else
				{

					if($my_data === null || $my_data === '')
					{
						continue;
					}

					// data is not array
					if(!is_array($my_data))
					{
						\dash\notif::error(T_("Field :val must be array", ['val' => $field_title]), ['element' => $field]);
						continue;
					}

					// no validation rule
					if(empty($validate))
					{
						continue;
					}


					$my_new_data = [];

					foreach ($my_data as $my_value)
					{
						if(!is_array($my_value))
						{
							\dash\notif::error(T_("Value of :val must be array", ['val' => $field]));
							continue;
						}

						if(count($my_value) !== count($validate))
						{
							\dash\notif::error(T_("Value of :val must be array and contain exactly need parameter", ['val' => $field]));
							continue;
						}

						$temp_data = [];

						foreach ($my_value as $my_field => $my_field_value)
						{
							if(!isset($validate[$my_field]))
							{
								\dash\notif::error(T_("This array key is not supported!"));
								continue;
							}

							if(is_string($validate[$my_field]))
							{
								$temp_data[$my_field] = self::data($validate[$my_field], $my_field_value, true, ['element' => $my_field, 'field_title' => $my_field]);
							}
							elseif(is_array($validate[$my_field]))
							{
								$my_enum = $validate[$my_field];
								foreach ($my_enum as $my_enum_item)
								{
									if(!is_string($my_enum_item) && !is_numeric($my_enum_item))
									{
										self::bye(T_("Enum option must be string or number"));
									}
								}
								$temp_data[$my_field] = self::data('enum', $my_field_value, true, ['enum' => $validate[$my_field], 'field_title' => $my_field, 'element' => $my_field]);
							}
							else
							{
								\dash\notif::error(T_("Validate array function must be string or array!"));
								self::bye();
							}
						}

						$my_new_data[] = $temp_data;
					}

					$check = $my_new_data;
				}
			}
			else
			{
				\dash\notif::error(T_("Validate function must be string or array!"));
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

				$field_title = $required_field;
				if(isset($_meta['field_title'][$required_field]) && is_string($_meta['field_title'][$required_field]))
				{
					$field_title = $_meta['field_title'][$required_field];
				}

				if(!$data[$required_field] && $data[$required_field] !== 0)
				{
					if($data[$required_field] === false && !\dash\engine\process::status())
					{
						// we have an error in this field. needless to alert required
					}
					else
					{
						\dash\notif::error(T_("Field :val is required", ['val' => $field_title]), ['code' => 1500, 'element' => $required_field]);
					}
				}
			}
		}

		if(!\dash\engine\process::status())
		{
			self::bye();
		}

		return $data;
	}



	public static function data($_cleans_function, $_data, $_notif = false, $_meta = [])
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

		// call function stirng_50 or string_500_20
		if(substr($function, 0, 6) === 'string')
		{
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
			// *************** mobile validate
			case 'mobile':
				$data = \dash\validate\mobile::mobile($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'ir_mobile':
				$data = \dash\validate\mobile::ir_mobile($_data, $_notif, $element, $field_title, $meta);
				break;



			// *************** string validate
			case 'string':
				$data = \dash\validate\text::string($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'address':
				$data = \dash\validate\text::address($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'title':
			case 'seotitle':
				$data = \dash\validate\text::title($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'html':
				$data = \dash\validate\text::html($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'desc':
			case 'seodesc':
				$data = \dash\validate\text::desc($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'username':
				$data = \dash\validate\text::username($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'slug':
				$data = \dash\validate\text::slug($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'barcode':
				$data = \dash\validate\text::barcode($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'sku':
				$data = \dash\validate\text::sku($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'url':
				$data = \dash\validate\text::url($_data, $_notif, $element, $field_title, $meta);
				break;

			// *************** password validate
			case 'password':
				$data = \dash\validate\password::password($_data, $_notif, $element, $field_title, $meta);
				break;


			// *************** identify validate
			case 'id':
				$data = \dash\validate\identify::id($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'code':
				$data = \dash\validate\identify::code($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'id_code':
				$data = \dash\validate\identify::id_code($_data, $_notif, $element, $field_title, $meta);
				break;


			// *************** array validate
			case 'enum':
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'order':
				$meta['enum'] = ['asc', 'desc'];
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;


			// *************** nationalcode validate
			case 'nationalcode':
				$data = \dash\validate\nationalcode::nationalcode($_data, $_notif, $element, $field_title, $meta);
				break;

			// *************** number validate
			case 'number':
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'number_positive':
				$data = \dash\validate\number::number_positive($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'smallint':
				$meta['min'] = 0;
				$meta['max'] = 9999;
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'percent':
				$data = \dash\validate\number::number_percent($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'price':
				$data = \dash\validate\number::price($_data, $_notif, $element, $field_title, $meta);
				break;


			// *************** bool validate
			case 'bool':
				$data = boolval($_data);
				break;


			default:
				self::bye(T_("Invalid vaidate function".' '. $function));
				break;
		}


		return $data;
	}




	private static function bye($_msg = null)
	{
		// \dash\notif::api($_msg);
		\dash\header::status(400, $_msg);
	}
}
?>