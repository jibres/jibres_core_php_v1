<?php
namespace content_love\domain\setting\business;


class view
{
	public static function config()
	{
		\dash\face::title(\dash\data::domainDetail_name());

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this(). '/search');

		$load_domain = \lib\app\business_domain\get::is_customer_domain(\dash\data::domainDetail_name());

		\dash\data::businessDomainDetail($load_domain);
	}
}
?>