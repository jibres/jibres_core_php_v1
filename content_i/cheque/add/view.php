<?php
namespace content_i\cheque\add;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add new cheque"));
		\dash\data::page_desc(T_("Add new cheque"));
		\dash\data::page_pictogram('new-sign');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back'));

		\dash\data::catList(\lib\app\category::list(null, ['pagenation' => false]));
		\dash\data::jibList(\lib\app\jib::my_list());

		\dash\data::bankList(\lib\app\bank::list(null, ['pagenation' => false]));
		\dash\data::chequebookList(\lib\app\chequebook::list(null, ['pagenation' => false]));

	}
}
?>