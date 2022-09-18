<?php
namespace content_a\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Dashboard"));

		\dash\face::desc(T_('Glance at your store summary and compare some important data together and enjoy Jibres!'). ' '. T_('Have a good day;)'));

		\dash\data::dashboardData(\lib\app\admin_dashboard\get::get());

		\dash\face::specialTitle(true);


		\dash\data::businessCheckLisst(\lib\app\setting\business_checklist::summary());


		if(!\dash\url::store() && \dash\engine\store::enable_plugin_admin_special_domain())
		{
			// hide back btn
		}
		else
		{
			// back
			\dash\data::back_text(T_('Control Center'));

			if(\dash\engine\store::admin_subdomain())
			{
				\dash\data::back_link(\dash\url::set_subdomain(\dash\engine\store::admin_subdomain()). '/my');
			}
			else
			{
				\dash\data::back_link(\dash\url::sitelang(). '/my');
			}
		}


		$smsDeail = \lib\app\sms_charge\charge::getDetail();

		\dash\data::smsChargeDetail($smsDeail);

	}
}
?>
