<?php
namespace content_crm\member\glance;


class view
{
	public static function config()
	{

		\dash\face::title(T_('Customer at a glance'));

		if(\dash\data::dataRowMember_permission())
		{
			\dash\data::back_text(T_("Staff List"));
			\dash\data::back_link(\dash\url::here(). '/staff');
		}
		else
		{
			\dash\data::back_text(T_("Customers"));
			\dash\data::back_link(\dash\url::this());
		}

		$dashboard = \dash\app\user\dashboard::one_user(\dash\request::get('id'));
		\dash\data::dashboardDetail($dashboard);
	}
}
?>