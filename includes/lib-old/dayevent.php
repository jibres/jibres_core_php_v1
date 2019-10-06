<?php
namespace lib;

class dayevent
{

	public static function calc()
	{
		$result['store']               = \lib\db\stores::get_count();
		$result['storetransaction']    = \dash\db\config::public_get_count('storetransactions');
		$result['userstore']           = \dash\db\config::public_get_count('userstores');
		$result['product']             = \dash\db\config::public_get_count('products');
		$result['factordetail']        = \dash\db\config::public_get_count('factordetails');
		$result['factor']              = \dash\db\config::public_get_count('factors');
		$result['sumfactor']           = \lib\db\factors::sum_all();
		$result['fund']                = \dash\db\config::public_get_count('funds');
		$result['inventory']           = \dash\db\config::public_get_count('inventory');
		$result['planhistory']         = \dash\db\config::public_get_count('planhistory');
		$result['productinventory']    = \dash\db\config::public_get_count('productinventory');
		$result['productprice']        = \dash\db\config::public_get_count('productprices');
		$result['productterm']         = \dash\db\config::public_get_count('productterms');
		$result['producttermusage']    = \dash\db\config::public_get_count('producttermusages');

		return $result;
	}
}
?>