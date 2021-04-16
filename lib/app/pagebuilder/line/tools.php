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
	 * Need redirect after save
	 *
	 * @var        <type>
	 */
	private static $need_redirect = null;


	/**
	 * Call function
	 *
	 * @param      <type>  $_class          The class
	 * @param      <type>  $_function_name  The function name
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function call_fn($_class, $_function_name, $_args = null, $_args2 = null)
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
				return call_user_func_array($fn, [$_args, $_args2]);
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
	public static function call_fn_args($_class, $_function_name, $_args, $_args2 = null)
	{
		return self::call_fn(...func_get_args());
	}



	/**
	 * All line contain this elements
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function get_contain($_element)
	{

		$contain = \lib\app\pagebuilder\line\tools::call_fn($_element, 'elements');

		if(!$contain || !is_array($contain) || !isset($contain['contain']) || !is_array($contain['contain']))
		{
			return [];
		}


		$new_contain = [];

		foreach ($contain['contain'] as $box => $inside)
		{
			$new_contain[] = $box;
			if(isset($inside['contain']) && is_array($inside['contain']))
			{
				foreach ($inside['contain'] as $inside_box => $inside_value)
				{
					$new_contain[] = $inside_box;
				}
			}
		}


		return $new_contain;
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
	 * Set redirect to
	 *
	 * @param      <type>  $_redirect_to  The redirect to
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function need_redirect($_redirect_to = null)
	{
		if($_redirect_to === null)
		{
			return self::$need_redirect;
		}
		else
		{
			self::$need_redirect = $_redirect_to;
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

		return $data;
	}



	public static function global_ready_show(string $_element, array $_data)
	{
		$data = $_data;

		if(isset($data['detail']) && is_string($data['detail']))
		{
			$data['detail'] = json_decode($data['detail'], true);
		}

		$contain = \lib\app\pagebuilder\line\tools::get_contain($_element);

		foreach ($contain as $one_contain)
		{
			$fn = ['\\lib\\app\\pagebuilder\\config\\'. $one_contain, 'ready'];

			if(is_callable($fn))
			{
				$data = call_user_func_array($fn, [$data]);
			}
		}

		return $data;
	}

}
?>