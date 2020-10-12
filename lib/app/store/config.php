<?php
namespace lib\app\store;


class config
{


	public static function init($_store_id, $_fuel, $_database, $_detail = [])
	{
		if(!$_store_id)
		{
			return null;
		}

		// set default unit
		if(\dash\url::tld() === 'com')
		{
			$currency = 'USD';
		}
		else
		{
			$currency = 'IRT';
		}

		\lib\db\setting\insert::default_setting('store_setting', 'currency', $currency, $_fuel, $_database);

		\lib\db\setting\insert::default_setting('store_setting', 'redirect_all_domain_to_master', '1', $_fuel, $_database);

		\lib\db\setting\insert::default_setting('store_setting', 'length_unit', 'cm', $_fuel, $_database);

		\lib\db\setting\insert::default_setting('store_setting', 'mass_unit', 'kg', $_fuel, $_database);

		\lib\db\setting\insert::default_setting('product_setting', 'comment', '1', $_fuel, $_database);

		\lib\db\setting\insert::default_setting('store_setting', 'lang', \dash\language::current(), $_fuel, $_database);

	}
}
?>