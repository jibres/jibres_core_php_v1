<?php
namespace content_a\accounting\year\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add accounting year'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::dataRow_startdate(\lib\app\tax\year\get::startdate());
		\dash\data::dataRow_enddate(\lib\app\tax\year\get::enddate());
		\dash\data::dataRow_title(\lib\app\tax\year\get::new_title());
	}
}
?>
