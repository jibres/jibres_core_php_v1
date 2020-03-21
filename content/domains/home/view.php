<?php
namespace content\domains\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Domain Registration'));
		\dash\data::page_desc(T_('Jibres offers cheap domain names with the most reliable service.'). ' '. T_('Buy or transfer a domain name today!'));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>