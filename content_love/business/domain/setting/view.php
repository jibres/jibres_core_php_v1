<?php
namespace content_love\business\domain\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain Detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::that());

		\content_love\business\domain\load::dashboardDetail();

		$result = \lib\app\business_domain\dns::check(\dash\data::dataRow_id());

	}
}
?>
