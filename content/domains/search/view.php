<?php
namespace content\domains\search;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Domain Name Search'));
		\dash\data::page_desc(T_('Every website starts with a great domain name.'). ' '. T_('Find your dream domain.'));
		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::kingdom(). '/domains');

		$q = \dash\request::get('q');
		$q = urldecode($q);
		$q = mb_strtolower($q);

		\dash\data::myDomain($q);
		$info = \lib\app\nic_domain\check::multi_check($q);

		\dash\data::infoResult($info);
	}
}
?>