<?php
namespace content_my\domain\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this(). '/search');


		if(a(\dash\data::domainDetail(), 'jibres_dns'))
		{
			\content_my\domain\setting\business\view::check_business();
		}

		$my_setting = \lib\app\nic_usersetting\get::get();
		if(isset($my_setting['defaultautorenew']) && $my_setting['defaultautorenew'])
		{
			\dash\data::defaultTitleautorenew(T_("Default (Enable)"));
		}
		else
		{
			\dash\data::defaultTitleautorenew(T_("Default (Disable)"));
		}

	}
}
?>