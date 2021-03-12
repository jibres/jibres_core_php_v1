<?php
namespace content_my\domain\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this(). '/search');


		if(a(\dash\data::domainDetail(), 'jibres_dns'))
		{
			\content_my\domain\setting\business\view::check_business();
		}
	}
}
?>