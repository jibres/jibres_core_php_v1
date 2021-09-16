<?php
namespace content\domains\pricing;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Hundreds Of Domains At Great Prices'));
		\dash\face::desc(T_('Use our domain price search tool to find the cost of popular domains.'). ' '. T_('Buy or transfer a domain name today!'));
		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::kingdom(). '/domains');

		$price = \lib\app\onlinenic\price::price_table();
		\dash\data::dataTable($price);
	}

}
?>