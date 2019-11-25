<?php
namespace content_a\setup\currency;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Store currency'));

		\dash\data::currencyList(\lib\currency::list());
	}
}
?>
