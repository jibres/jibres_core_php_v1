<?php
namespace content_a\setting\accounting\resetnumber;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting resetnumber setting'));

		// back
		\dash\data::back_text(T_('Accounting setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::accountingYear(\lib\app\tax\year\get::list());

	}
}
?>