<?php
namespace lib\pagebuilder\tools;


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
	 * Get the curret page detail
	 *
	 * @var        <type>
	 */
	private static $current_module = null;


	public static function get_fn($_folder, $_class, $_function_name)
	{
		$namespace = '\\lib\\pagebuilder\\%s\\%s\\%s';
		$namespace = sprintf($namespace, $_folder, $_class, $_class);

		$fn = [ $namespace, $_function_name	];

		return $fn;
	}
	/**
	 * Call function
	 *
	 * @param      <type>  $_class          The class
	 * @param      <type>  $_function_name  The function name
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function call_fn($_folder, $_class, $_function_name, $_args = null, $_args2 = null)
	{
		$fn = self::get_fn($_folder, $_class, $_function_name);

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
	public static function call_fn_args($_folder, $_class, $_function_name, $_args, $_args2 = null)
	{
		return self::call_fn(...func_get_args());
	}



	/**
	 * All line contain this elements
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function get_contain($_folder, $_element)
	{

		$contain = \lib\pagebuilder\tools\tools::call_fn($_folder, $_element, 'elements');

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


	public static function get_element_title($_folder, $_element)
	{
		$detail = \lib\pagebuilder\tools\tools::call_fn($_folder, $_element, 'detail');

		if(isset($detail['title']))
		{
			return $detail['title'];
		}

		return T_("Unknown");

	}

	/**
	 * Save and get curret page detail
	 *
	 * @param      <type>  $_current_module  The current page
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function current_module($_current_module = null)
	{
		if($_current_module === null)
		{
			return self::$current_module;
		}
		else
		{
			self::$current_module = $_current_module;
		}
	}


	public static function in($_module)
	{
		if(isset(self::$current_module['current_module']) && self::$current_module['current_module'] === $_module)
		{
			return true;
		}
		else
		{
			return false;
		}
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
			// set once
			if(!in_array($_exception, self::$input_exception))
			{
				self::$input_exception[] = $_exception;
			}
		}
	}


	/**
	 * Set redirect to
	 *
	 * @param      <type>  $_redirect_to  The redirect to
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function need_redirect($_redirect_to = null, $_force = false)
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


	public static function global_ready_for_db(array $_data)
	{
		$data = [];

		if(array_key_exists('title', $_data))
		{
			$data['title'] = $_data['title'];
		}

		return $data;
	}



	public static function global_ready_show(string $_folder, string $_element, array $_data)
	{
		$data = $_data;

		if(isset($data['detail']) && is_string($data['detail']))
		{
			$data['detail'] = json_decode($data['detail'], true);
		}

		if(isset($data['background']) && is_string($data['background']))
		{
			$data['background'] = json_decode($data['background'], true);
		}

		$contain = \lib\pagebuilder\tools\tools::get_contain($_folder, $_element);

		foreach ($contain as $one_contain)
		{
			if(is_callable(self::get_fn($_folder, $one_contain, 'ready')))
			{
				$data = self::call_fn_args($_folder, $one_contain, 'ready', $data);
			}
		}

		if(is_callable(self::get_fn($_folder, $_element, 'ready')))
		{
			$data = self::call_fn_args($_folder, $_element, 'ready', $data);
		}


		return $data;
	}

}
?>