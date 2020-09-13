<?php
namespace content_love\business\domain\dns;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain DNS Detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::that());

		\content_love\business\domain\load::dashboardDetail();



		$dnsList = \lib\app\business_domain\dns::list(\dash\data::dataRow_id());
		\dash\data::dnsList($dnsList);


	}
}
?>
