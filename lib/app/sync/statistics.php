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
		}
	}

	/**
	 * Call in \dash\app\dayevent
	 */
	public static function calc()
	{
		$result                        = [];
		$result['user']                = floatval(\dash\db\users::get_count());
		$result['user_mobile']         = floatval(\dash\db\users::get_count_have_mobile());
		$result['user_email']          = floatval(\dash\db\users::get_count_have_email());
		$result['user_username']       = floatval(\dash\db\users::get_count_have_username());
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

		$result['customer']            = floatval(\dash\db\users::get_count_not_removed());
		$result['staff']               = floatval(\dash\db\users::get_count_have_permission());

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
		$result['session']             = floatval(\dash\db\login\get::get_count_all());
		$result['ticket']              = floatval(\dash\db\tickets\get::count_ticket());
		$result['ticket_message']      = floatval(\dash\db\tickets\get::count_message());
		$result['comment']             = floatval(\dash\db\comments\get::get_count());
		$result['address']             = floatval(\dash\db\address::get_count());
		$result['transaction']         = floatval(\dash\db\transactions::get_count());

		$result['news']                = floatval(\dash\db\posts\get::get_count(['type' => 'post']));
		$result['page']                = floatval(\dash\db\posts\get::get_count(['type' => 'page']));
		$result['help']                = floatval(\dash\db\posts\get::get_count(['type' => 'help']));
		$result['attachment']          = floatval(\dash\db\posts\get::get_count(['type' => 'attachment']));
		$result['post']                = floatval(\dash\db\posts\get::get_count(['type' => 'post']));

		$result['term']                = floatval(\dash\db\terms\get::get_count());
		$result['tag']                 = floatval(\dash\db\terms\get::get_count(['type' => 'tag']));
		$result['cat']                 = floatval(\dash\db\terms\get::get_count(['type' => 'cat']));
		$result['support_tag']         = floatval(\dash\db\terms\get::get_count(['type' => 'support_tag']));
		$result['help_tag']            = floatval(\dash\db\terms\get::get_count(['type' => 'help_tag']));

		$result['termusages']          = floatval(\dash\db\termusages\get::get_count_all());

		$result['user_chatid']         = floatval(\dash\db\user_telegram::get_count());
		$result['user_android']        = floatval(\dash\db\user_android::get_count());


		$result['user_permission']      = floatval(\dash\db\users::get_count_have_permission());
		$result['app_download']         = floatval(\dash\pdo\query_template::get_count('app_download'));
		$result['csrf']                 = floatval(\dash\pdo\query_template::get_count('csrf'));
		$result['dayevent']             = floatval(\dash\pdo\query_template::get_count('dayevent'));
		$result['factoraction']         = floatval(\dash\pdo\query_template::get_count('factoraction'));
		$result['factorshipping']        = floatval(\dash\pdo\query_template::get_count('factorshipping'));
		$result['files']                = floatval(\dash\pdo\query_template::get_count('files'));
		$result['fileusage']            = floatval(\dash\pdo\query_template::get_count('fileusage'));
		$result['form']                 = floatval(\dash\pdo\query_template::get_count('form'));
		$result['form_answer']          = floatval(\dash\pdo\query_template::get_count('form_answer'));
		$result['form_answerdetail']    = floatval(\dash\pdo\query_template::get_count('form_answerdetail'));
		$result['form_choice']          = floatval(\dash\pdo\query_template::get_count('form_choice'));
		$result['form_filter']          = floatval(\dash\pdo\query_template::get_count('form_filter'));
		$result['form_filter_where']    = floatval(\dash\pdo\query_template::get_count('form_filter_where'));
		$result['form_item']            = floatval(\dash\pdo\query_template::get_count('form_item'));
		$result['funds']                = floatval(\dash\pdo\query_template::get_count('funds'));
		$result['importexport']         = floatval(\dash\pdo\query_template::get_count('importexport'));
		// $result['inventory']            = floatval(\dash\pdo\query_template::get_count('inventory'));
		$result['ir_vat']               = floatval(\dash\pdo\query_template::get_count('ir_vat'));
		$result['log_notif']            = floatval(\dash\pdo\query_template::get_count('log_notif'));
		$result['login']                = floatval(\dash\pdo\query_template::get_count('login'));
		$result['login_ip']             = floatval(\dash\pdo\query_template::get_count('login_ip'));
		$result['pos']                  = floatval(\dash\pdo\query_template::get_count('pos'));
		$result['productcategory']      = floatval(\dash\pdo\query_template::get_count('productcategory'));
		$result['productcategoryusage'] = floatval(\dash\pdo\query_template::get_count('productcategoryusage'));
		$result['productinventory']     = floatval(\dash\pdo\query_template::get_count('productinventory'));
		$result['productprices']        = floatval(\dash\pdo\query_template::get_count('productprices'));
		$result['productproperties']    = floatval(\dash\pdo\query_template::get_count('productproperties'));
		$result['producttag']           = floatval(\dash\pdo\query_template::get_count('producttag'));
		$result['producttagusage']      = floatval(\dash\pdo\query_template::get_count('producttagusage'));
		$result['productunit']          = floatval(\dash\pdo\query_template::get_count('productunit'));
		$result['setting']              = floatval(\dash\pdo\query_template::get_count('setting'));
		$result['tax_coding']           = floatval(\dash\pdo\query_template::get_count('tax_coding'));
		$result['tax_docdetail']        = floatval(\dash\pdo\query_template::get_count('tax_docdetail'));
		$result['tax_document']         = floatval(\dash\pdo\query_template::get_count('tax_document'));
		$result['tax_year']             = floatval(\dash\pdo\query_template::get_count('tax_year'));
		$result['telegrams']            = floatval(\dash\pdo\query_template::get_count('telegrams'));
		$result['urls']                 = floatval(\dash\pdo\query_template::get_count('urls'));
		$result['user_auth']            = floatval(\dash\pdo\query_template::get_count('user_auth'));
		$result['user_telegram']        = floatval(\dash\pdo\query_template::get_count('user_telegram'));
		$result['userdetail']           = floatval(\dash\pdo\query_template::get_count('userdetail'));
		$result['visitors']             = floatval(\dash\pdo\query_template::get_count('visitors'));

		return $result;

	}


	private static function make_query($_args, $_store_id)
	{
		$query    = "SELECT store_analytics.id FROM store_analytics WHERE store_analytics.id = :store_id LIMIT 1";
		$param    = [':store_id' => $_store_id];

		$check = \dash\pdo::get($query, $param, null, true, 'master');


		if($check)
		{
			return \dash\pdo\query_template::update('store_analytics', $_args, $_store_id, 'master');
		}
		else
		{
			$_args['id'] = $_store_id;
			return \dash\pdo\query_template::insert('store_analytics', $_args, 'master');
		}

	}
}
?>