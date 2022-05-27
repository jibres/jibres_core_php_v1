<?php
namespace content_a\accounting\report\vatreport;


class view
{
	public static function config()
	{
		\dash\data::dataRow(\lib\app\tax\year\get::default_year());

		\dash\face::title(T_('Quarterly tax report'). ' | '. \dash\data::dataRow_title());
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
		\dash\face::btnSetting(\dash\url::this(). '/year/vatsetting?id='. \dash\data::dataRow_id());

		$dataTable = \lib\app\tax\doc\report\vatreport::get();

		if(!is_array($dataTable))
		{
			$dataTable = [];
		}
		\dash\data::dataTable($dataTable);


	}
}
?>
