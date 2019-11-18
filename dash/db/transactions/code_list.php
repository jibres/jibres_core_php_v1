<?php
namespace dash\db\transactions;

trait code_list
{
	/**
	 * make caller
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function config()
	{
		$list     = [];
		$list[1]  = "payment:parsian";
		$list[2]  = "payment:zarinpal";
		$list[3]  = "manually";
		$list[4]  = "repair";
		$list[5]  = "invoice";
		$list[6]  = "payment:irkish";
		$list[7]  = "send:sms";
		$list[8]  = "payment:payir";
		$list[9]  = "payment:asanpardakht";
		$list[10] = "payment:mellat";
		$list[11] = "payment";

		if($option_list = \dash\option::config('transactions_code'))
		{
			if(is_array($option_list))
			{
				foreach ($option_list as $key => $value)
				{
					$list[$key] = $value;
				}
			}
		}

		return $list;
	}

	/**
	 * Gets the code.
	 *
	 * @param      <type>  $_caller  The caller
	 */
	public static function get_code($_caller)
	{
		$list = self::config();
		foreach ($list as $key => $value)
		{
			if($value == $_caller)
			{
				return $key;
			}
		}
		return null;
	}

	public static function get_caller($_code)
	{
		$list = self::config();
		foreach ($list as $key => $value)
		{
			if($key == $_code)
			{
				return $value;
			}
		}
		return null;
	}
}
?>
