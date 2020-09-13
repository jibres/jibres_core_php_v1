<?php
namespace content_love\business\domain\log;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain Detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::that());

		\content_love\business\domain\load::dashboardDetail();

		$list = \lib\app\business_domain\action::domain_action_list(\dash\data::dataRow_id());
		\dash\data::dataTable($list);


	}
}
?>
