<?php
namespace content\domains\irnic;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('IRNIC - Dot-IR (.ir) ccTLD Registry Agreement'));
		\dash\data::page_desc(\dash\data::site_desc());
		\dash\data::page_desc(T_('Every website starts with a great domain name.'). ' '. T_('Find your dream domain.'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		$q = \dash\request::get('q');
		\dash\data::myDomain($q);
		$info = \lib\app\nic_domain\check::multi_check($q);

		\dash\data::infoResult($info);
	}
}
?>