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
		$result['users']               = \dash\db\users::get_count();
		$result['user_mobile']         = \dash\db\users::get_count(['mobile' => ['IS NOT', 'NULL']]);
		$result['user_email']          = \dash\db\users::get_count(['email' => ['IS NOT', 'NULL']]);
		$result['user_username']       = \dash\db\users::get_count(['username' => ['IS NOT', 'NULL']]);
		$result['user_awaiting']       = \dash\db\users::get_count(['status' => 'awaiting']);
		$result['user_removed']        = \dash\db\users::get_count(['status' => 'removed']);
		$result['user_filter']         = \dash\db\users::get_count(['status' => 'filter']);
		$result['user_unreachabl']     = \dash\db\users::get_count(['status' => 'unreachabl']);

		$result['lastactivity']        = \lib\store::get_last_update();
		$result['lastchangesetting']   = null;
		$result['lastadminlogin']      = null;
		$result['laststafflogin']      = null;
		$result['lastsale']            = \lib\db\factors\get::last_sale_date();
		$result['lastbuy']             = \lib\db\factors\get::last_buy_date();
		$result['dbtrafic']            = null;
		$result['dbsize']              = null;

		$result['customer']            = \dash\db\users::get_count(['status' => [' != ', "'removed'"]]);
		$result['staff']               = \dash\db\users::get_count(['permission' => ['IS NOT', 'NULL']]);

		$result['sumplustransaction']  = \dash\db\transactions::sum_plus();
		$result['summinustransaction'] = \dash\db\transactions::sum_minus();

		$result['product']             = \lib\db\products\get::count_all();
		$result['factor']              = \lib\db\factors\get::count_all();
		$result['factorbuy']           = \lib\db\factors\get::count_all_buy();
		$result['factorsale']          = \lib\db\factors\get::count_all_sale();
		$result['factordetail']        = \lib\db\factordetails\get::count_all();
		$result['sumfactor']           = \lib\db\factors\get::sum_all();
		$result['planhistory']         = null; // store.planhistory table not found
		$result['cart']                = \lib\db\cart\get::count_all();
		$result['sync']                = \lib\db\sync\get::count_all();
		$result['apilog']              = \dash\db\apilog::get_count();

		$result['log']                 = \dash\db\logs::get_count();
		$result['agent']               = \dash\db\agents::get_count();
		$result['session']             = \dash\db\sessions::get_count();
		$result['ticket']              = \dash\db\tickets::get_count(['parent' => null]);
		$result['ticket_message']      = \dash\db\tickets::get_count(['parent' => ['IS NOT', 'NULL']]);
		$result['comment']             = \dash\db\comments::get_count();
		$result['address']             = \dash\db\address::get_count();
		$result['transaction']         = \dash\db\transactions::get_count();

		$result['news']                = \dash\db\posts::get_count(['type' => 'post']);
		$result['page']                = \dash\db\posts::get_count(['type' => 'page']);
		$result['help']                = \dash\db\posts::get_count(['type' => 'help']);
		$result['attachment']          = \dash\db\posts::get_count(['type' => 'attachment']);
		$result['post']                = \dash\db\posts::get_count(['type' => ['NOT IN ',"('post', 'page', 'help', 'attachment')"]]);

		$result['term']                = \dash\db\terms::get_count();
		$result['tag']                 = \dash\db\terms::get_count(['type' => 'tag']);
		$result['cat']                 = \dash\db\terms::get_count(['type' => 'cat']);
		$result['support_tag']         = \dash\db\terms::get_count(['type' => 'support_tag']);
		$result['help_tag']            = \dash\db\terms::get_count(['type' => 'help_tag']);

		$result['termusages']          = \dash\db\termusages::get_count();

		$result['user_chatid']         = \dash\db\user_telegram::get_count();
		$result['user_android']        = \dash\db\user_android::get_count();

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