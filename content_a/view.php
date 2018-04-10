<?php
namespace content_a;


class view
{
	public static function config()
	{
		\dash\data::site_title(T_("Jibres"));
		\dash\data::site_desc(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\data::site_slogan(T_("Integrated Sales and Online Accounting"));


		// transfer to new location on root of content
		\dash\data::display_admin('content_a/layout.html');

		\dash\data::bodyclass('siftal');
		\dash\data::include_chart(true);

		\dash\data::site_title(\lib\store::name());
		\dash\data::store(\lib\store::detail());

		// set shortkey for all badges is this content
		\dash\data::badge_shortkey(120);

		// set usable variable
		\dash\data::moduleType(\dash\request::get('type'));
		\dash\data::moduleTypeP('?type='. \dash\data::moduleType());
	}
}
?>