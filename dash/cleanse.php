<?php
namespace dash;
/**
 * Class for validate input
 *
 *
 * FUNCTION NAME FROM VALIDATE
 *
 * ------------------ MOBILE
 *->  mobile
 *->  ir_mobile
 *
 * ------------------ STRING
 *->  string
 *->  address
 *->  title
 *->  seotitle
 *->  displayname
 *->  html
 *->  desc
 *->  seodesc
 *->  username
 *->  slug
 *->  barcode
 *->  sku
 *->  search
 *->  language
 *->  email
 *->  md5
 *->  subdomain
 *
 * ------------------ URL
 *->  url
 *->  domain
 *->  ir_domain
 *->  ip
 *->  dns
 *
 * ------------------ DATE
 *->  birthdate
 *->  date
 *->  datetime
 *->  time
 *
 * ------------------ LOCATION
 *->  country
 *->  province
 *->  city
 *
 * ------------------ PASSWORD
 *->  password
 *
 * ------------------ IDENTIFY
 *->  id
 *->  code
 *->  id_code
 *
 * ------------------ ARRAY
 *->  enum
 *->  weekday
 *->  order
 *->  tag
 *
 * ------------------ NATIONAL CODE
 *->  nationalcode
 *
 * ------------------ NUMBER
 *->  number
 *->  int
 *->  bigint
 *->  float
 *->  number_negative
 *->  smallint
 *->  verification_code
 *->  postcode
 *->  phone
 *->  percent
 *->  price
 *
 * ------------------ IRNIC
 *->  irnic_id
 *
 * ------------------ BOOL
 *->  bool
 *->  bit
 *
 *
 * ------------------------------ call to validate data ------------------------------
 * @call \dash\validate::{function_name}(data, element, field_title, meta);
 * @call \dash\validate\clean::data({functio_name}, data, element, field_title, meta);
 *
 * @example:
 * 		$string = \dash\validate::string($_input);				// check $_input is string
 * 		$string = \dash\validate::string_50($_input);			// check $_input is string and less than 50 character
 * 		$string = \dash\validate::string_100_10($_input);		// check $_input is string and less than 50 character and larger than 10 character
 *
 * @author: Reza <rm.biqarar@gmail.com>
 * @date: 2020-03-16
 *
 */
class cleanse
{

	public static $status = true;

	public static function input($_args, $_condition, $_required = [], $_meta = [])
	{
		self::$status = true;

		if(!is_array($_args))
		{
			\dash\notif::error(T_("First Arguments of input function is required!"));
			self::$status = false;
			self::bye();
		}

		if(!is_array($_condition))
		{
			\dash\notif::error(T_("Second Arguments of input function is required!"));
			self::$status = false;
			self::bye();
		}

		if(!is_array($_required))
		{
			\dash\notif::error(T_("Third Arguments of input function must be array!"));
			self::$status = false;
			self::bye();
		}

		if(!is_array($_meta))
		{
			\dash\notif::error(T_("Fourth Arguments of input function must be array!"));
			self::$status = false;
			self::bye();
		}

		$input = $_args;

		$data  = [];


		foreach ($_condition as $field => $validate)
		{
			if(!is_string($field))
			{
				\dash\notif::error(T_("Index of condition arguments must be string!"));
				self::$status = false;
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
				$check = self::data($validate, $my_data, true, ['element' => $field, 'field_title' => $field_title, 'continue_with_error' => true]);
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
					$check = self::data('enum', $my_data, true, ['enum' => $validate['enum'], 'field_title' => $field_title, 'element' => $field, 'continue_with_error' => true]);
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
						self::$status = false;
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
							self::$status = false;
							continue;
						}

						if(count($my_value) !== count($validate))
						{
							\dash\notif::error(T_("Value of :val must be array and contain exactly need parameter", ['val' => $field]));
							self::$status = false;
							continue;
						}

						$temp_data = [];

						foreach ($my_value as $my_field => $my_field_value)
						{
							if(!isset($validate[$my_field]))
							{
								\dash\notif::error(T_("This array key is not supported!"));
								self::$status = false;
								continue;
							}

							if(is_string($validate[$my_field]))
							{
								$temp_data[$my_field] = self::data($validate[$my_field], $my_field_value, true, ['element' => $my_field, 'field_title' => $my_field, 'continue_with_error' => true]);
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
								$temp_data[$my_field] = self::data('enum', $my_field_value, true, ['enum' => $validate[$my_field], 'field_title' => $my_field, 'element' => $my_field, 'continue_with_error' => true]);
							}
							else
							{
								\dash\notif::error(T_("Validate array function must be string or array!"));
								self::$status = false;
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
				self::$status = false;
				self::bye();
			}

			$data[$field] = $check;

		}

		if(count($input) >= 1)
		{
			// in import product needless to check args
			// because my export have some field and we not get in add new product
			if(\dash\temp::get('clesnse_not_check_needless_args'))
			{
				// nothing
			}
			else
			{
				$msg = T_("Needless arguments was received!");
				if(\dash\url::isLocal())
				{
					$msg .= ' '. json_encode(array_keys($input));
				}
				\dash\notif::error($msg);
				self::$status = false;
				self::bye();
			}
		}

		if($_required)
		{
			foreach ($_required as $required_field)
			{
				if(!is_string($required_field))
				{
					\dash\notif::error(T_("Arguments of required field must be string!"));
					self::$status = false;
					continue;
				}

				if($required_field === '')
				{
					\dash\notif::error(T_("Arguments of required field cannot be empty string!"));
					self::$status = false;
					continue;
				}


				if(!array_key_exists($required_field, $_condition))
				{
					\dash\notif::error(T_("Field :val is required but not set in condition args!", ['val' => $required_field]));
					self::$status = false;
					continue;
				}

				if(!array_key_exists($required_field, $_args))
				{
					// not reseive required field
					continue;
				}

				$field_title = T_(ucfirst($required_field));
				if(isset($_meta['field_title'][$required_field]) && is_string($_meta['field_title'][$required_field]))
				{
					$field_title = $_meta['field_title'][$required_field];
				}
				// contain null, '', 0, false
				if(!$data[$required_field])
				{
					$send_variable = false;

					if(is_numeric($data[$required_field]))
					{
						if(floatval($data[$required_field]) === floatval(0))
						{
							$send_variable = true;
						}
					}

					if(!$send_variable)
					{
						if($data[$required_field] === false && !self::$status)
						{
							// we have an error in this field. needless to alert required
						}
						else
						{
							\dash\notif::error(T_("Field :val is required", ['val' => $field_title]), ['code' => 1500, 'element' => $required_field]);
							self::$status = false;
						}
					}
				}
			}
		}


		if(!self::$status)
		{
			// in import product we need to check all input
			if(\dash\temp::get('clesnse_not_end_with_error'))
			{
				// nothing
			}
			else
			{
				self::bye();
			}
		}

		return $data;
	}


	/**
	 * Unset every index not send from user
	 */
	public static function patch_mode($_input, $_data)
	{
		if(!is_array($_input))
		{
			\dash\notif::error(T_("First Arguments of patch mode function is required!"));
			self::$status = false;
			self::bye();
		}

		if(!is_array($_data))
		{
			\dash\notif::error(T_("Second Arguments of patch mode function is required!"));
			self::$status = false;
			self::bye();
		}

		$clean_data = $_data;

		foreach ($_data as $key => $value)
		{
			if(!array_key_exists($key, $_input))
			{
				unset($clean_data[$key]);
			}
		}

		return $clean_data;
	}



	public static function data($_cleans_function, $_data, $_notif = true, $_meta = [])
	{
		// self::$status = true;

		if(self::$status === false)
		{
			// no change in status if have erro
		}
		else
		{
			self::$status = true;
		}


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

		$continue_with_error = false;
		if(isset($_meta['continue_with_error']) && $_meta['continue_with_error'])
		{
			$continue_with_error = true;
		}

		if(isset($_meta['element']) && is_string($_meta['element']))
		{
			$element = $_meta['element'];
		}

		if(isset($_meta['field_title']) && is_string($_meta['field_title']))
		{
			$field_title = $_meta['field_title'];
		}
		else
		{
			$field_title = T_(ucfirst($element));
		}

		// call function stirng_50 or string_500_20
		// call function enstirng_50 or enstring_500_20
		if(substr($function, 0, 6) === 'string' || substr($function, 0, 8) === 'enstring' || substr($function, 0, 9) === 'intstring')
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

		$fn_args = [$_data, $_notif, $element, $field_title, $meta];

		switch ($function)
		{

			case 'mobile': 				$data = \dash\validate\mobile::mobile(...$fn_args); 				break;
			case 'ir_mobile': 			$data = \dash\validate\mobile::ir_mobile(...$fn_args); 				break;
			case 'string': 				$data = \dash\validate\text::string(...$fn_args); 					break;
			case 'enstring': 			$data = \dash\validate\text::enstring(...$fn_args); 				break;
			case 'intstring': 			$data = \dash\validate\text::intstring(...$fn_args); 				break;
			case 'html': 				$data = \dash\validate\text::html(...$fn_args); 					break;
			case 'html_basic': 			$data = \dash\validate\text::html_basic(...$fn_args); 				break;
			case 'username': 			$data = \dash\validate\text::username(...$fn_args); 				break;
			case 'slug': 				$data = \dash\validate\text::slug(...$fn_args); 					break;
			case 'barcode': 			$data = \dash\validate\text::barcode(...$fn_args); 					break;
			case 'sku': 				$data = \dash\validate\text::sku(...$fn_args); 						break;
			case 'search': 				$data = \dash\validate\text::search(...$fn_args); 					break;
			case 'email': 				$data = \dash\validate\text::email(...$fn_args); 					break;
			case 'md5': 				$data = \dash\validate\text::md5(...$fn_args); 						break;
			case 'subdomain': 			$data = \dash\validate\subdomain::subdomain(...$fn_args); 			break;
			case 'iban': 				$data = \dash\validate\iban::check(...$fn_args); 					break;
			case 'iban_detail': 		$data = \dash\validate\iban::detail(...$fn_args); 					break;
			case 'url': 				$data = \dash\validate\url::url(...$fn_args); 						break;
			case 'domain_clean': 		$data = \dash\validate\url::domain_clean(...$fn_args); 				break;
			case 'domain': 				$data = \dash\validate\url::domain(...$fn_args); 					break;
			case 'domain_root': 		$data = \dash\validate\url::domain_root(...$fn_args); 				break;
			case 'ir_domain': 			$data = \dash\validate\url::ir_domain(...$fn_args); 				break;
			case 'ip': 					$data = \dash\validate\url::ip(...$fn_args); 						break;
			case 'ipv4': 				$data = \dash\validate\url::ipv4(...$fn_args); 						break;
			case 'ipv6': 				$data = \dash\validate\url::ipv6(...$fn_args); 						break;
			case 'dns': 				$data = \dash\validate\url::dns(...$fn_args); 						break;
			case 'birthdate': 			$data = \dash\validate\datetime::birthdate(...$fn_args); 			break;
			case 'date': 				$data = \dash\validate\datetime::date(...$fn_args); 				break;
			case 'datetime': 			$data = \dash\validate\datetime::datetime(...$fn_args); 			break;
			case 'time': 				$data = \dash\validate\datetime::time(...$fn_args); 				break;
			case 'country': 			$data = \dash\validate\location::country(...$fn_args); 				break;
			case 'province': 			$data = \dash\validate\location::province(...$fn_args); 			break;
			case 'city': 				$data = \dash\validate\location::city(...$fn_args); 				break;
			case 'password': 			$data = \dash\validate\password::password(...$fn_args); 			break;
			case 'id': 					$data = \dash\validate\identify::id(...$fn_args); 					break;
			case 'code': 				$data = \dash\validate\identify::code(...$fn_args); 				break;
			case 'id_code': 			$data = \dash\validate\identify::id_code(...$fn_args); 				break;
			case 'enum': 				$data = \dash\validate\dataarray::enum(...$fn_args); 				break;
			case 'tag': 				$data = \dash\validate\dataarray::tag(...$fn_args); 				break;
			case 'tag_long': 			$data = \dash\validate\dataarray::tag_long(...$fn_args); 			break;
			case 'nationalcode': 		$data = \dash\validate\nationalcode::nationalcode(...$fn_args); 	break;
			case 'number': 				$data = \dash\validate\number::number(...$fn_args); 				break;
			case 'int': 				$data = \dash\validate\number::int(...$fn_args); 					break;
			case 'float': 				$data = \dash\validate\number::float(...$fn_args); 					break;
			case 'number_negative': 	$data = \dash\validate\number::number_negative(...$fn_args); 		break;
			case 'postcode': 			$data = \dash\validate\number::postcode(...$fn_args); 				break;
			case 'postcode_ir': 		$data = \dash\validate\number::postcode_ir(...$fn_args); 			break;
			case 'phone': 				$data = \dash\validate\number::phone(...$fn_args); 					break;
			case 'percent': 			$data = \dash\validate\number::number_percent(...$fn_args); 		break;
			case 'price': 				$data = \dash\validate\number::price(...$fn_args); 					break;
			case 'irnic_id': 			$data = \dash\validate\irnic::irnic_id(...$fn_args); 				break;
			case 'bit': 				$data = $_data ? 1 : null; 											break;

			case 'bool':
					if($_data === null)
					{
						$data = null;
					}
					else
					{
						$data = boolval($_data);
					}
				break;

			case 'currency':
				$meta['enum'] = array_keys(\lib\currency::list());
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'language':
			case 'lang':
				$data = \dash\validate\text::language(...$fn_args);
				break;

			case 'address':
				$meta['min'] = 5;
				$meta['max'] = 300;
				$data = \dash\validate\text::string($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'title':
			case 'seotitle':
				$meta['min'] = 1;
				$meta['max'] = 200;
				$data = \dash\validate\text::string($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'displayname':
				$meta['min'] = 1;
				$meta['max'] = 100;
				$data = \dash\validate\text::string($_data, $_notif, $element, $field_title, $meta);
				break;


			case 'desc':
			case 'seodesc':
				$meta['min'] = 0;
				$meta['max'] = 2000;
				$meta['need_new_line'] = true;
				$data = \dash\validate\text::string($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'order':
				$meta['enum'] = ['asc', 'desc', 'ASC', 'DESC'];
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'y_n':
				$meta['enum'] = ['y', 'n'];
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'array':
			case 'isarray':
				$data = \dash\validate\dataarray::isarray($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'weekday':
				$meta['enum'] = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'star':
				$meta['enum'] = ['1', '2', '3', '4', '5'];
				$data = \dash\validate\dataarray::enum($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'bigint':
				$meta['min']   = 0;
				$meta['max']   = 9999999999999999999;
				$meta['round'] = true;
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'smallint':
				$meta['min']   = 0;
				$meta['max']   = 9999;
				$meta['round'] = true;
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'count':
			case 'shipping_price':
				// count is DECIMAL(13, 4)
				// shipping is DECIMAL(13, 4)
				// we can save 9 digit number and 4 decimal
				// in this function we limit digit on 6 :)
				$meta['min']   = 0;
				$meta['max']   = 999999;
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'qty':
				// qty is DECIMAL(19, 4)
				// so we have 15 digit number
				// we limit it at 14
				$meta['min']   = 0;
				$meta['max']   = 99999999999999;
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;

			case 'total':
				// total is DECIMAL(31, 4)
				// we can save 27 digit number and 4 decimal
				// in this function we limit digit on 26 :)
				$meta['min']   = 0;
				$meta['max']   = 99999999999999999999999999;
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;


			case 'verification_code':
				$meta['min']   = 10000;
				$meta['max']   = 99999;
				$meta['round'] = true;
				$data = \dash\validate\number::number($_data, $_notif, $element, $field_title, $meta);
				break;

			default:
				self::bye(T_("Invalid vaidate function".' '. $function));
				break;
		}

		// only whene call this function from self::input() needless to end code in every validate
		// the code will be ended in that function (self::input())
		if(!$continue_with_error)
		{
			// everywhere call validate and have error in validate code must be ended
			if(!self::$status)
			{
				self::bye();
			}
		}

		return $data;
	}




	private static function bye($_msg = null)
	{
		if($_msg)
		{
			\dash\notif::error($_msg);
		}

		// show all result in local
		if(\dash\url::isLocal())
		{
			// \dash\notif::api("END CLEANSE FUNCTION");
		}

		if(\dash\temp::get('clesnse_not_end_with_error'))
		{
			\dash\header::set(423);
		}
		else
		{
			if(\dash\request::json_accept() || \dash\request::ajax() || \dash\engine\content::api_content())
			{
				\dash\header::set(423);
			}
			else
			{
				\dash\header::status(423, $_msg);
			}

			\dash\code::end();
		}

	}
}
?>