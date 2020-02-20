<?php
namespace content\domains\search;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Domain Name Search'));
		\dash\data::page_desc(\dash\data::site_desc());
		\dash\data::page_desc(T_('Every website starts with a great domain name.'). ' '. T_('Find your dream domain.'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

	}
}
?>