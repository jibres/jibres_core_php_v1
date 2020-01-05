<?php
namespace content_a\setting\units;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Store Units'));

		\dash\data::currencyList(\lib\currency::list());
		\dash\data::massList(\lib\units::mass());
		\dash\data::lengthList(\lib\units::length());

		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());
	}
}
?>
