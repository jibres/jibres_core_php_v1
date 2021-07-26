<?php
namespace content_a\accounting\report\quarter;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Quarterly sell and buy report'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
		\dash\data::dataRow(\lib\app\tax\year\get::default_year());

		$type      = \dash\request::get('type');

		$dataTable = \lib\app\tax\doc\report\quarter::get($type);

		if(!is_array($dataTable))
		{
			$dataTable = [];
		}

		\dash\data::dataTable($dataTable);
	}
}
?>
