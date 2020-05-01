<?php
namespace content\domains\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Domain Registration'));
		\dash\face::desc(T_('Jibres offers cheap domain names with the most reliable service.'). ' '. T_('Buy or transfer a domain name today!'));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\data::script_page('/js/page/test2.js');
	}
}
?>