<?php
namespace dash;
/**
 * Class for clean args
 */
class cleanse
{
	public static function input($_args, $_condition, $_required = [])
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


			$myData = $input[$field];

			// to check count of needless arguments
			unset($input[$field]);

			$check = false;

			if(is_string($validate))
			{
				$check = self::data($myData, $validate, true);
			}
			elseif(is_array($validate))
			{
				if(isset($validate['enum']) && is_array($validate['enum']))
				{
					$check = self::data($myData, 'enum', true, $validate['enum']);
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



	public static function data($_data, $_cleans_function, $_notif = false, $_meta = null)
	{
		if(!$_cleans_function)
		{
			self::bye(T_("Validate function is required!"));
		}

		if(!is_string($_cleans_function))
		{
			self::bye(T_("Validate function must be string!"));
		}

		$function = $_cleans_function;
		$extra    = null;
		$data     = null;

		if(strpos($function, '_') !== false)
		{
			$explode = explode('_', $function);
			if(isset($explode[0]))
			{
				$function = $explode[0];
			}

			if(isset($explode[1]))
			{
				$extra = $explode[1];
			}
		}

		switch ($function)
		{
			case 'price':
				$data = \dash\validate\number::price($_data, $_notif);
				break;

			case 'mobile':
				$data = \dash\validate\number::mobile($_data, $_notif);
				break;

			case 'string':
				$data = \dash\validate\text::string($_data, $_notif, $extra);
				break;


			case 'password':
				$data = \dash\validate\text::password($_data, $_notif);
				break;

			case 'enum':
				$data = \dash\validate\dataarray::enum($_data, $_notif, $_meta);
				break;


			default:
				self::bye(T_("Invalid vaidate function ". $function));
				break;
		}


		return $data;
	}




	private static function bye($_msg = null)
	{
		\dash\header::status(400, $_msg);
	}
}
?>