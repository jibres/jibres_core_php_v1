<?php
namespace content_a\setting\fund;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Fund'));

		\dash\data::dataTable(\lib\app\fund\search::all_list());

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>