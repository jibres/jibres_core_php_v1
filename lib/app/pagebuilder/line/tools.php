<?php
namespace lib\app\pagebuilder\line;


class tools
{
	/**
	 * The exception input on pathc mode
	 *
	 * @var        array
	 */
	private static $input_exception = [];


	/**
	 * Call function
	 *
	 * @param      <type>  $_class          The class
	 * @param      <type>  $_function_name  The function name
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function call_fn($_class, $_function_name, $_args = null)
	{
		$fn =
		[
			'\\lib\\app\\pagebuilder\\elements\\'. $_class,
			$_function_name
		];

		if(is_callable($fn))
		{
			if($_args !== null)
			{
				return call_user_func_array($fn, [$_args]);
			}
			else
			{
				return call_user_func($fn);
			}

		}
		return false;
	}


	/**
	 * Call function by args
	 *
	 * @param      <type>  $_class          The class
	 * @param      <type>  $_function_name  The function name
	 * @param      <type>  $_args           The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function call_fn_args($_class, $_function_name, $_args)
	{
		return self::call_fn(...func_get_args());
	}



	/**
	 * All line contain this elements
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function global_contain()
	{
		return
		[
			'platform',
			'title',
			'titlesetting',
			'background',
			'avand',
			'margin',
			'padding',
			'radius',
			'ifloginshow',
			'ifpermissionshow',
			// 'puzzle',
			// 'infoposition',
		];
	}



	/**
	 * Global input
	 * this variable was find in every elements
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function global_input_condition()
	{
		$condition =
		[
			'title' => 'string_100',
			'avand' => \lib\app\pagebuilder\config\avand::input_condition(),
			'radius' => \lib\app\pagebuilder\config\radius::input_condition(),
		];

		return $condition;
	}


	/**
	 * Input exception in patch mode
	 *
	 * @param      <type>  $_exception  The exception
	 */
	public static function input_exception($_exception = null)
	{
		if($_exception === null)
		{
			return self::$input_exception;
		}
		else
		{
			self::$input_exception[] = $_exception;
		}
	}



	/**
	 * Clean input
	 * some variable reapeat eat page need to clean before run
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function global_clean_input(array $_args)
	{
		unset($_args['csrf']);
		unset($_args['submitall']);

		return $_args;
	}


	public static function global_ready_for_save_db(array $_data)
	{
		$data = [];

		if(array_key_exists('title', $_data))
		{
			$data['title'] = $_data['title'];
		}

		\lib\app\pagebuilder\config\titlesetting::ready_for_save_db($data, $_data);
		\lib\app\pagebuilder\config\avand::ready_for_save_db($data, $_data);
		\lib\app\pagebuilder\config\radius::ready_for_save_db($data, $_data);

		return $data;
	}



	public static function global_ready_show(array $_data)
	{
		$data = $_data;

		\lib\app\pagebuilder\config\titlesetting::ready($data);
		\lib\app\pagebuilder\config\avand::ready($data);
		\lib\app\pagebuilder\config\radius::ready($data);

		return $data;
	}

}
?>