<?php
namespace content_a;

class view
{
	public static function config()
	{
		// transfer to new location on root of content
		\dash\data::display_admin('content_a/layout.html');

		\dash\data::bodyclass('siftal');
		\dash\data::include_chart(true);

		\dash\data::site_title(\lib\store::name());
		\dash\data::store(\lib\store::detail());

		// set shortkey for all badges is this content
		// $this->data->page['badge']['shortkey'] = 120;
		\dash\data::page_badge_shortkey(120);

		// set usable variable
		\dash\data::moduleType(\dash\request::get('type'));
		\dash\data::moduleTypeP('?type='. \dash\data::moduleType());
	}
}
?>