<?php
namespace lib\app\sync;

/**
 * This class describes statistics.
 */
class statistics
{

	/**
	 * Start sync statistics from stores to jibres
	 */
	public static function fire()
	{
		if(\dash\engine\store::inStore())
		{
			$calc  = self::calc();
			$query = self::make_query($calc, \lib\store::id());

			\lib\app\sync\tools::add($query, 'master');
		}
	}


	private static function calc()
	{
		$result                        = [];
		$result['users']               = floatval(\dash\db\users::get_count());
		$result['user_mobile']         = floatval(\dash\db\users::get_count(['mobile' => ['IS NOT', 'NULL']]));
		$result['user_email']          = floatval(\dash\db\users::get_count(['email' => ['IS NOT', 'NULL']]));
		$result['user_username']       = floatval(\dash\db\users::get_count(['username' => ['IS NOT', 'NULL']]));
		$result['user_awaiting']       = floatval(\dash\db\users::get_count(['status' => 'awaiting']));
		$result['user_removed']        = floatval(\dash\db\users::get_count(['status' => 'removed']));
		$result['user_filter']         = floatval(\dash\db\users::get_count(['status' => 'filter']));
		$result['user_unreachabl']     = floatval(\dash\db\users::get_count(['status' => 'unreachabl']));

		$result['lastactivity']        = \lib\store::get_last_update();
		$result['lastchangesetting']   = null;
		$result['lastadminlogin']      = null;
		$result['laststafflogin']      = null;
		$result['lastsale']            = \lib\db\factors\get::last_sale_date();
		$result['lastbuy']             = \lib\db\factors\get::last_buy_date();
		$result['dbtrafic']            = null;
		$result['dbsize']              = null;

		$result['customer']            = floatval(\dash\db\users::get_count(['status' => [' != ', "'removed'"]]));
		$result['staff']               = floatval(\dash\db\users::get_count(['permission' => ['IS NOT', 'NULL']]));

		$result['sumplustransaction']  = floatval(\dash\db\transactions::sum_plus());
		$result['summinustransaction'] = floatval(\dash\db\transactions::sum_minus());

		$result['product']             = floatval(\lib\db\products\get::count_all());
		$result['factor']              = floatval(\lib\db\factors\get::count_all());
		$result['factorbuy']           = floatval(\lib\db\factors\get::count_all_buy());
		$result['factorsale']          = floatval(\lib\db\factors\get::count_all_sale());
		$result['factordetail']        = floatval(\lib\db\factordetails\get::count_all());
		$result['sumfactor']           = floatval(\lib\db\factors\get::sum_all());
		$result['planhistory']         = null;
		$result['cart']                = floatval(\lib\db\cart\get::count_all());
		$result['sync']                = floatval(\lib\db\sync\get::count_all());
		$result['apilog']              = floatval(\dash\db\apilog::get_count());

		$result['log']                 = floatval(\dash\db\logs::get_count());
		$result['agent']               = floatval(\dash\db\agents::get_count());
		$result['session']             = floatval(\dash\db\sessions::get_count());
		$result['ticket']              = floatval(\dash\db\tickets::get_count(['parent' => null]));
		$result['ticket_message']      = floatval(\dash\db\tickets::get_count(['parent' => ['IS NOT', 'NULL']]));
		$result['comment']             = floatval(\dash\db\comments::get_count());
		$result['address']             = floatval(\dash\db\address::get_count());
		$result['transaction']         = floatval(\dash\db\transactions::get_count());

		$result['news']                = floatval(\dash\db\posts::get_count(['type' => 'post']));
		$result['page']                = floatval(\dash\db\posts::get_count(['type' => 'page']));
		$result['help']                = floatval(\dash\db\posts::get_count(['type' => 'help']));
		$result['attachment']          = floatval(\dash\db\posts::get_count(['type' => 'attachment']));
		$result['post']                = floatval(\dash\db\posts::get_count(['type' => ['NOT IN ',"('post', 'page', 'help', 'attachment')"]]));

		$result['term']                = floatval(\dash\db\terms::get_count());
		$result['tag']                 = floatval(\dash\db\terms::get_count(['type' => 'tag']));
		$result['cat']                 = floatval(\dash\db\terms::get_count(['type' => 'cat']));
		$result['support_tag']         = floatval(\dash\db\terms::get_count(['type' => 'support_tag']));
		$result['help_tag']            = floatval(\dash\db\terms::get_count(['type' => 'help_tag']));

		$result['termusages']          = floatval(\dash\db\termusages::get_count());

		$result['user_chatid']         = floatval(\dash\db\user_telegram::get_count());
		$result['user_android']        = floatval(\dash\db\user_android::get_count());

		return $result;

	}


	private static function make_query($_set, $_store_id)
	{
		$make_set = \dash\db\config::make_set($_set);
		$query = "INSERT INTO store_analytics SET $make_set, store_analytics.id = $_store_id ON DUPLICATE KEY UPDATE $make_set";
		return $query;
	}
}
?>