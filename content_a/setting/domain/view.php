<?php
namespace content_a\setting\domain;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Domain'));


		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());


		$domain_list = \lib\app\store\domain::get_domain_list();
		\dash\data::domainList($domain_list);
	}
}
?>