<?php
namespace dash\utility\pay;


class transactions
{

	/**
	 * start transaction
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function start($_args)
	{
		return \dash\db\transactions::set($_args);
	}


	public static function update()
	{
		return \dash\db\transactions::update(...func_get_args());
	}


	public static function calc_budget()
	{
		return \dash\db\transactions::calc_budget(...func_get_args());
	}

	public static function load()
	{
		$result = \dash\db\transactions::load(...func_get_args());
		$result = \dash\app\transaction::ready($result);
		return $result;
	}

	public static function load_banktoken()
	{
		return \dash\db\transactions::load_banktoken(...func_get_args());
	}

	public static function load_banktoken_transaction_id()
	{
		return \dash\db\transactions::load_banktoken_transaction_id(...func_get_args());
	}
}
?>