<?php
namespace content_a\accounting\year\vatreport;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Quarterly tax report settings'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/manage?id='. \dash\request::get('id'));

		\dash\data::accountingSettingSaved(\lib\app\setting\get::accounting_setting());

		$dataTable = \lib\app\tax\doc\report\vatreport::get(\dash\data::dataRow());

		\dash\data::dataTable($dataTable);


	}
}
?>
