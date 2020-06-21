<?php
namespace content_a\setting\units;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Store Units'));

		\dash\data::currencyList(\lib\currency::list());
		\dash\data::massList(\lib\units::mass());
		\dash\data::lengthList(\lib\units::length());


		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/general');
	}
}
?>
