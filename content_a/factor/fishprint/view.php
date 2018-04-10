<?php
namespace content_a\factor\fishprint;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Print factor'));
		\dash\data::page_desc(T_('You can search in list of factors, add new factor and edit existing.'));

		\dash\data::badge_text(T_('Back to last sales'));
		\dash\data::badge_link(\dash\url::this());


		\dash\data::pageSize(\dash\request::get('size'));

		\dash\data::factorDetail(\lib\app\factor::get(['id' => \dash\request::get('id')], []));
	}
}
?>
