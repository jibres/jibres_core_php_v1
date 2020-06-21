<?php
namespace content\domains\pricing;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Domain Price'));
		\dash\face::desc(T_('Jibres offers cheap domain names with the most reliable service.'). ' '. T_('Buy or transfer a domain name today!'));
		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::kingdom(). '/domains');

		$price = \lib\app\onlinenic\price::get_all();
		\dash\data::dataTable($price);
	}
}
?>