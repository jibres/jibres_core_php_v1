<?php
namespace content_a\setup\units;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Store Units'));

		\dash\data::currencyList(\lib\currency::list());
		\dash\data::massList(\lib\units::mass());
		\dash\data::lengthList(\lib\units::length());
	}
}
?>
